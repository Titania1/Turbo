<?php

namespace App\Observers;

use App\Car;

class CarObserver
{
	/**
	 * Handle the car "creating" event.
	 *
	 * @param  \App\Car  $car
	 * @return void
	 */
	public function creating(Car $car): void
	{
		$car->slug = sluggify($car->type);
	}

	/**
	 * Handle the car "updating" event.
	 *
	 * @param  \App\Car  $car
	 * @return void
	 */
	public function updating(Car $car): void
	{
		if ($car->isDirty('type')) {
			$car->slug = sluggify($car->type);
		}
	}
}
