<?php

declare(strict_types=1);

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;

class PrintReceipt extends Action
{
	use InteractsWithQueue, Queueable;

	/**
	 * Get the displayable name of the action.
	 */
	public function name(): string
	{
		return __('Print Receipt');
	}

	/**
	 * Perform the action on the given models.
	 */
	public function handle(ActionFields $fields, Collection $models)
	{
		foreach ($models as $receipt) {
			return Action::redirect("/print/receipt/$receipt->id");
		}
	}

	/**
	 * Get the fields available on the action.
	 *
	 * @return array
	 */
	public function fields()
	{
		return [];
	}
}
