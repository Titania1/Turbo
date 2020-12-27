<?php

declare(strict_types=1);

namespace App\Nova;

use Armincms\Fields\BelongsToMany;
use Emiliogrv\NovaBatchLoad\BatchLoadField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;

class Invoice extends Resource
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
		return __('Invoices');
	}

	/**
	 * Get the displayable singular label of the resource.
	 */
	public static function singularLabel(): string
	{
		return __('Invoice');
	}

	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = 'App\Invoice';

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
		'supplier' => ['name', 'address', 'credit', 'phone'],
	];

	/**
	 * Get a fresh instance of the model represented by the resource.
	 */
	public static function newModel()
	{
		$model = static::$model;
		$var = new $model();
		// Set the dafault value for the reception date
		$var->reception_date = now();

		return $var;
	}

	/**
	 * Get the fields displayed by the resource.
	 */
	public function fields(Request $request): array
	{
		return [
			ID::make()->sortable(),
			DateTime::make(__('Reception Date'), 'reception_date')->required(),
			BatchLoadField::make()
				->accept('.xlsx') // Optional
				->defaultTabActive(1) // Optional
				->ignoreAttributes('parts') // Optional
				->keepOriginalFields('belongs|select|boolean'), // Optional
			BelongsTo::make(__('Supplier'), 'supplier', Supplier::class)->showCreateRelationButton(),
			BelongsToMany::make(__('Parts'), 'parts', Part::class)->hideFromIndex()
				->fields(function () {
					return [
						Number::make(__('Buy Price'), 'buy_price')
							->min(1)->max(1e6)->step(0.01)
							->required()->displayUsing(fn () => round($this->buy_price).' DZD'),
						Number::make(__('Sell Price'), 'sell_price')
							->min(1)->max(1e6)->step(0.01)
							->required()->displayUsing(fn () => round($this->sell_price).' DZD'),
						Number::make(__('Quantity'), 'quantity')
							->rules('required', 'numeric'),
					];
				})
				->pivots(),
		];
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
		return [];
	}
}
