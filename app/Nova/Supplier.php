<?php

declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Supplier extends Resource
{
	/**
	 * Get the displayable label of the resource.
	 */
	public static function label(): string
	{
		return __('Suppliers');
	}

	/**
	 * Get the displayable singular label of the resource.
	 */
	public static function singularLabel(): string
	{
		return __('Supplier');
	}

	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = 'App\Supplier';

	/**
	 * The single value that should be used to represent the resource when being displayed.
	 *
	 * @var string
	 */
	public static $title = 'name';

	/**
	 * The columns that should be searched.
	 *
	 * @var array
	 */
	public static $search = [
		'name', 'address', 'credit', 'phone',
	];

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @return array
	 */
	public function fields(Request $request)
	{
		return [
			ID::make()->sortable(),
			Text::make(__('Name'), 'name')->required()->sortable(),
			Place::make(__('Address'), 'address')->hideFromIndex()->required(),
			Number::make(__('Phone number'), 'phone')->resolveUsing(fn ($phone) => 0 .$phone),
			Number::make(__('Credit'), 'credit')->displayUsing(fn ($credit) => round($credit).' DZD'),
		];
	}

	/**
	 * Build an "index" query for the given resource.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public static function indexQuery(NovaRequest $request, $query)
	{
		return $query->where('owner_id', auth()->id());
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
