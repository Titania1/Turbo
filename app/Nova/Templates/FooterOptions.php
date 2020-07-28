<?php

declare(strict_types=1);

namespace App\Nova\Templates;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Place;
use Whitecube\NovaPage\Pages\Template;

class FooterOptions extends Template
{
	protected $jsonAttributes = ['comment'];

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @return array
	 */
	public function fields(Request $request)
	{
		return [
			Text::make(__('Comment'), 'comment')->translatable(),
			Text::make(__('Email Address'), 'email'),
			Place::make(__('Location Address'), 'address'),
			Text::make(__('Working Hours'), 'schedule'),
			Text::make(__('Facebook Page'), 'facebook'),
			Text::make(__('Twitter Account'), 'twitter'),
			Text::make(__('Youtube Channel'), 'youtube'),
			Text::make(__('Instagram Account'), 'instagram'),
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
