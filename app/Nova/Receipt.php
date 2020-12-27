<?php

declare(strict_types=1);

namespace App\Nova;

use App\PartReceipt;
use App\Nova\Receipt\Part;
use Illuminate\Http\Request;
use App\Nova\Actions\PrintReceipt;
use Armincms\Fields\BelongsToMany;
use Laravel\Nova\Fields\{BelongsTo, Boolean, DateTime, Number};
class Receipt extends Resource
{
	/**
	 * Get the logical group associated with the resource.
	 *
	 * @return string
	 */
	public static function group()
	{
		return __('Counter');
	}

	/**
	 * Get the displayable label of the resource.
	 */
	public static function label(): string
	{
		return __('Receipts');
	}

	/**
	 * Get the displayable singular label of the resource.
	 */
	public static function singularLabel(): string
	{
		return __('Receipt');
	}

	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = 'App\Receipt';

	/**
	 * The single value that should be used to represent the resource when being displayed.
	 *
	 * @var string
	 */
	public static $title = 'id';

	/**
	 * The columns that should be searched.
	 *
	 * @var array
	 */
	public static $search = [
		'id',
	];

	/**
	 * The relationship columns that should be searched.
	 *
	 * @var array
	 */
	public static $searchRelations = [
		'client' => ['name', 'address', 'credit', 'phone'],
	];

	/**
	 * Get a fresh instance of the model represented by the resource.
	 */
	public static function newModel()
	{
		$model = static::$model;
		$receipt = new $model();
		// Set the dafault value for the reception date
		$receipt->vat = 19;
		$receipt->display_vat = true;

		return $receipt;
	}

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @return array
	 */
	public function fields(Request $request)
	{
		return [
			DateTime::make(__('Created at'), function () {
				return $this->created_at;
			}),
			$this->clientField(),
			// Should only show parts which we have stock for
			BelongsToMany::make(__('Parts'), 'parts', 'App\Nova\Receipt\Part')->hideFromIndex()
				->fields(function ($ids) {
					$part_receipt = PartReceipt::where([
						'part_id'    => $ids['relatedId'],
						'receipt_id' => $ids['resourceId'],
					])->first();

					return [
						Number::make(__('Quantity'), 'quantity')
							->rules('required', 'numeric')
							->displayUsing(fn () => $part_receipt->quantity),
					];
				})
				->pivots(),
			Number::make(__('VAT'), 'vat')->nullable()->displayUsing(fn ($vat) => $vat.'%'),
			Boolean::make(__('Show on receipt'), 'display_vat')->nullable(),
			Number::make(__('Total of parts'), function () {
				return $this->parts()->count();
			}),
			Number::make(__('Total Quantity'), function () {
				$quantity = 0;
				foreach ($this->parts as $part) {
					$quantity += (int) $part->pivot->quantity;
				}
				// Get the quantity of each part in the receipt
				return $quantity;
			}),
			Number::make(__('Total'), function () {
				$price = 0;
				foreach ($this->parts as $part) {
					$price += ($part->price * (int) $part->pivot->quantity);
				}
				// Get the quantity of each part in the receipt
				return $price;
			}),
		];
	}

	protected function clientField()
	{
		return BelongsTo::make(__('Client'), 'client', Client::class)->showCreateRelationButton();
	}

	/**
	 * Get the cards available for the request.
	 *
	 * @return array
	 */
	public function cards(Request $request)
	{
		return [];
	}

	/**
	 * Get the filters available for the resource.
	 *
	 * @return array
	 */
	public function filters(Request $request)
	{
		return [];
	}

	/**
	 * Get the lenses available for the resource.
	 *
	 * @return array
	 */
	public function lenses(Request $request)
	{
		return [];
	}

	/**
	 * Get the actions available for the resource.
	 *
	 * @return array
	 */
	public function actions(Request $request)
	{
		return [
			new PrintReceipt(),
		];
	}
}
