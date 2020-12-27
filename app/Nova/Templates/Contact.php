<?php

declare(strict_types=1);

namespace App\Nova\Templates;

use Illuminate\Http\Request;
use Whitecube\NovaPage\Pages\Template;
use GeneaLabs\NovaMapMarkerField\MapMarker;
use SadekD\NovaOpeningHoursField\NovaOpeningHoursField;

class Contact extends Template
{
	protected $jsonAttributes = ['opening_hours'];

	/**
	 * The page's title.
	 *
	 * @var string
	 */
	protected $title = 'Contact Page';

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @return array
	 */
	public function fields(Request $request)
	{
		return [
			MapMarker::make(__('Address'))->defaultZoom(17)
				->defaultLatitude(36.6966649)
				->defaultLongitude(3.0922204)
				->searchLabel(__('Enter Address')),
			NovaOpeningHoursField::make(__('Opening Hours'), 'opening_hours'),
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
}
