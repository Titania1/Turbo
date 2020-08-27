<?php

namespace App\Observers;

use App\VehicleModel;

class VehicleModelObserver
{
	/**
	 * Handle the vehicle model "creating" event.
	 *
	 * @param  \App\VehicleModel  $vehicleModel
	 * @return void
	 */
	public function creating(VehicleModel $vehicleModel)
	{
		$vehicleModel->slug = sluggify($vehicleModel->name);
	}

	/**
	 * Handle the vehicle model "created" event.
	 *
	 * @param  \App\VehicleModel  $vehicleModel
	 * @return void
	 */
	public function created(VehicleModel $vehicleModel)
	{
		//
	}

	/**
	 * Handle the vehicle model "updating" event.
	 *
	 * @param  \App\VehicleModel  $vehicleModel
	 * @return void
	 */
	public function updating(VehicleModel $vehicleModel)
	{
		if ($vehicleModel->isDirty('name')) {
			$vehicleModel->slug = sluggify($vehicleModel->name);
		}
	}

	/**
	 * Handle the vehicle model "updated" event.
	 *
	 * @param  \App\VehicleModel  $vehicleModel
	 * @return void
	 */
	public function updated(VehicleModel $vehicleModel)
	{
		//
	}

	/**
	 * Handle the vehicle model "deleted" event.
	 *
	 * @param  \App\VehicleModel  $vehicleModel
	 * @return void
	 */
	public function deleted(VehicleModel $vehicleModel)
	{
		//
	}

	/**
	 * Handle the vehicle model "restored" event.
	 *
	 * @param  \App\VehicleModel  $vehicleModel
	 * @return void
	 */
	public function restored(VehicleModel $vehicleModel)
	{
		//
	}

	/**
	 * Handle the vehicle model "force deleted" event.
	 *
	 * @param  \App\VehicleModel  $vehicleModel
	 * @return void
	 */
	public function forceDeleted(VehicleModel $vehicleModel)
	{
		//
	}
}
