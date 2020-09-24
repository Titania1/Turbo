<?php

declare(strict_types=1);

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\ActionRequest;

class ChangePartViews extends Action implements ShouldQueue
{
	use InteractsWithQueue, Queueable;

	/**
	 * Get the displayable name of the action.
	 */
	public function name(): string
	{
		return __('Update Part View Count');
	}

	/**
	 * Perform the action on the given models.
	 */
	public function handle(ActionFields $fields, Collection $models)
	{
		foreach ($models as $model) {
			Redis::zadd('popular_parts', $fields->score, $model->id);
		}
	}

	public function handleRequest(ActionRequest $request)
	{
		parent::handleRequest($request);

		return Action::message(__('Views count updated successfully!'));
	}

	/**
	 * Get the fields available on the action.
	 *
	 * @return array
	 */
	public function fields()
	{
		return [
			Number::make(__('Views'), 'score'),
		];
	}
}
