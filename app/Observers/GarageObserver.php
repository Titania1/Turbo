<?php

namespace App\Observers;

use App\Garage;

class GarageObserver
{
	/**
	 * Handle the garage "creating" event.
	 *
	 * @param  \App\Garage  $garage
	 * @return void
	 */
	public function creating(Garage $garage): void
	{
		// This check is only useful when seeding
		if (auth()->check()) {
			$garage->user_id = auth()->id();
		}
	}

	/**
	 * Handle the garage "created" event.
	 *
	 * @param  \App\Garage  $garage
	 * @return void
	 */
	public function created(Garage $garage)
	{
		//
	}

	/**
	 * Handle the garage "updated" event.
	 *
	 * @param  \App\Garage  $garage
	 * @return void
	 */
	public function updated(Garage $garage)
	{
		//
	}

	/**
	 * Handle the garage "deleted" event.
	 *
	 * @param  \App\Garage  $garage
	 * @return void
	 */
	public function deleted(Garage $garage)
	{
		//
	}

	/**
	 * Handle the garage "restored" event.
	 *
	 * @param  \App\Garage  $garage
	 * @return void
	 */
	public function restored(Garage $garage)
	{
		//
	}

	/**
	 * Handle the garage "force deleted" event.
	 *
	 * @param  \App\Garage  $garage
	 * @return void
	 */
	public function forceDeleted(Garage $garage)
	{
		//
	}
}
