<?php

namespace App\Observers;

use App\Model;

class ModelObserver
{
	/**
	 * Handle the model "creating" event.
	 *
	 * @param  \App\Model  $model
	 * @return void
	 */
	public function creating(Model $model)
	{
		$model->slug = sluggify($model->name);
	}

	/**
	 * Handle the model "updated" event.
	 *
	 * @param  \App\Model  $model
	 * @return void
	 */
	public function updated(Model $model)
	{
		if ($model->isDirty('name')) {
			$model->slug = sluggify($model->name);
		}
	}
}
