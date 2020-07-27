<?php

declare(strict_types=1);

namespace App\Observers;

use App\StoreAbout;

class StoreAboutObserver
{
	/**
	 * Handle the store about "creating" event.
	 *
	 * @return void
	 */
	public function creating(StoreAbout $storeAbout)
	{
		$storeAbout->store_id = auth()->user()->store->id;
	}

	/**
	 * Handle the store about "created" event.
	 *
	 * @return void
	 */
	public function created(StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Handle the store about "updated" event.
	 *
	 * @return void
	 */
	public function updated(StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Handle the store about "deleted" event.
	 *
	 * @return void
	 */
	public function deleted(StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Handle the store about "restored" event.
	 *
	 * @return void
	 */
	public function restored(StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Handle the store about "force deleted" event.
	 *
	 * @return void
	 */
	public function forceDeleted(StoreAbout $storeAbout)
	{
		//
	}
}
