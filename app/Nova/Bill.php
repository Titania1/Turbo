<?php

declare(strict_types=1);

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;

class Bill extends Receipt
{
	/**
	 * Get the displayable label of the resource.
	 */
	public static function label(): string
	{
		return __('Bills');
	}

	/**
	 * Get the displayable singular label of the resource.
	 */
	public static function singularLabel(): string
	{
		return __('Bill');
	}

	/**
	 * Get a fresh instance of the model represented by the resource.
	 */
	public static function newModel()
	{
		$model = static::$model;
		$receipt = new $model;
		// Set the dafault value for the reception date
		$receipt->vat = 19;
		$receipt->client_id = 1;
		$receipt->display_vat = true;

		return $receipt;
	}

	protected function clientField()
	{
		return BelongsTo::make(__('Client'), 'client', Client::class)
			->hideFromIndex()->readonly()->default(1);
	}
}
