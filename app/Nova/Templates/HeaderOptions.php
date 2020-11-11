<?php

declare(strict_types=1);

namespace App\Nova\Templates;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Whitecube\NovaPage\Pages\Template;

class HeaderOptions extends Template
{
	protected $jsonAttributes = ['slogan'];

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @return array
	 */
	public function fields(Request $request)
	{
		return [
			Text::make(__('Slogan'), 'slogan')->translatable(),
			Image::make(__('Logo'), 'logo'),
			Number::make(__('Phone number'), 'phone')
				->rules('required', 'digits:10', 'regex:/^(0)(5|6|7)(4|5|6|7)[0-9]{7}$/')
				->hideFromIndex(),
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
