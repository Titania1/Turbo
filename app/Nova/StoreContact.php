<?php

declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use Bissolli\NovaPhoneField\PhoneNumber;
use GeneaLabs\NovaMapMarkerField\MapMarker;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\{BelongsTo, Place, Text, Trix};
use SadekD\NovaOpeningHoursField\NovaOpeningHoursField;

class StoreContact extends Resource
{
	/**
	 * The logical group associated with the resource.
	 *
	 * @var string
	 */
	public static $group = 'Store';

	/**
	 * Get the displayable label of the resource.
	 */
	public static function label(): string
	{
		return __('Contact');
	}

	/**
	 * Get the displayable singular label of the resource.
	 */
	public static function singularLabel(): string
	{
		return __('Contact');
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
		if ($request->user()->hasRole('Super Admin')) {
			return $query;
		}

		return $query->where('store_id', optional(auth()->user()->store)->id);
	}

	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = 'App\StoreContact';

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
	 * Get the fields displayed by the resource.
	 *
	 * @return array
	 */
	public function fields(Request $request)
	{
		return [
			BelongsTo::make(__('Store'), 'store', Store::class)->canSee(
				fn ($request) => $request->user()->hasRole('Super Admin')
			),
			MapMarker::make(__('Address'))->defaultZoom(17)
				->defaultLatitude(36.6966649)
				->defaultLongitude(3.0922204)
				->searchLabel(__('Enter Address')),
			NovaOpeningHoursField::make(__('Opening Hours'), 'opening_hours'),
			$this->addressFields(),
			Text::make(__('Email'), 'email')
				->sortable()
				->rules('nullable', 'email', 'max:254')
				->creationRules('unique:store_contacts,email')
				->updateRules('unique:store_contacts,email,{{ resourceId }}'),
			PhoneNumber::make(__('Phone Number'), 'phone')->onlyCountries('DZ'),
			Trix::make(__('Comment'), 'comment'),
			// Links to social pages, FB, Twitter, YouTube, Insta, TikTok
		];
	}

	/**
	 * Get the address fields for the resource.
	 *
	 * @return \Illuminate\Http\Resources\MergeValue
	 */
	protected function addressFields()
	{
		return $this->merge([
			Place::make('Address', 'address')->hideFromIndex()->countries(['DZ']),
			// Text::make('Address Line 2')->hideFromIndex(),
			// Text::make('City')->hideFromIndex(),
			// Text::make('State')->hideFromIndex(),
			// Text::make('Postal Code')->hideFromIndex(),
			// Text::make('Suburb')->hideFromIndex(),
			// Country::make('Country')->hideFromIndex(),
			// Text::make('Latitude')->hideFromIndex(),
			// Text::make('Longitude')->hideFromIndex(),
		]);
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
