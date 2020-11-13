<?php

declare(strict_types=1);

namespace App\Nova;

use App\Nova\Order\Supplier;
use App\OrderPart;
use Armincms\Fields\BelongsToMany;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany as FieldsBelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
	/**
	 * Get the displayable label of the resource.
	 */
	public static function label(): string
	{
		return __('Orders');
	}

	/**
	 * Get the displayable singular label of the resource.
	 */
	public static function singularLabel(): string
	{
		return __('Order');
	}

	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = 'App\Order';

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
	 * Build an "index" query for the given resource.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public static function indexQuery(NovaRequest $request, $query)
	{
		return $query->where('user_id', auth()->id());
	}

	/**
	 * Build a "detail" query for the given resource.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public static function detailQuery(NovaRequest $request, $query)
	{
		return parent::detailQuery($request, $query->where('user_id', auth()->id()));
	}

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @return array
	 */
	public function fields(Request $request)
	{
		return [
			ID::make()->sortable(),
			BelongsTo::make(__('Supplier'), 'supplier', Supplier::class)->required()->searchable(),
			BelongsToMany::make(__('Parts'), 'parts', Part::class)->hideFromIndex()
				->fields(function ($ids) {
					$order_part = OrderPart::where([
						'part_id'  => $ids['relatedId'],
						'order_id' => $ids['resourceId'],
					])->first();

					return [
						Number::make(__('Quantity'), 'quantity')
							->rules('required', 'numeric')->displayUsing(function () use ($order_part) {
								return $order_part->quantity;
							}),
					];
				})
				->pivots(),
			FieldsBelongsToMany::make(__('Parts'), 'parts', Part::class),
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
