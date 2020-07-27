<?php

namespace App\Observers;

use App\StoreAbout;

class StoreAboutObserver
{
	/**
	 * Handle the store about "creating" event.
	 *
	 * @param  \App\StoreAbout  $storeAbout
	 * @return void
	 */
	public function creating(StoreAbout $storeAbout)
	{
		$storeAbout->store_id = auth()->user()->store->id;
	}

	/**
	 * Handle the store about "created" event.
	 *
	 * @param  \App\StoreAbout  $storeAbout
	 * @return void
	 */
	public function created(StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Handle the store about "updated" event.
	 *
	 * @param  \App\StoreAbout  $storeAbout
	 * @return void
	 */
	public function updated(StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Handle the store about "deleted" event.
	 *
	 * @param  \App\StoreAbout  $storeAbout
	 * @return void
	 */
	public function deleted(StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Handle the store about "restored" event.
	 *
	 * @param  \App\StoreAbout  $storeAbout
	 * @return void
	 */
	public function restored(StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Handle the store about "force deleted" event.
	 *
	 * @param  \App\StoreAbout  $storeAbout
	 * @return void
	 */
	public function forceDeleted(StoreAbout $storeAbout)
	{
		//
	}
}
