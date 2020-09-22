<?php

declare(strict_types=1);

namespace App\Observers;

use App\Vehicle;

class VehicleObserver
{
	/**
	 * Handle the vehicle model "creating" event.
	 *
	 * @return void
	 */
	public function creating(Vehicle $vehicle)
	{
		$vehicle->slug = sluggify($vehicle->name);
	}

	/**
	 * Handle the vehicle model "updating" event.
	 *
	 * @return void
	 */
	public function updating(Vehicle $vehicle)
	{
		if ($vehicle->isDirty('name')) {
			$vehicle->slug = sluggify($vehicle->name);
		}
	}
}
