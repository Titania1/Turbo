<?php

declare(strict_types=1);

namespace App\Observers;

use App\Store;

class StoreObserver
{
	/**
	 * Handle the store "creating" event.
	 *
	 * @return void
	 */
	public function creating(Store $store)
	{
		$store->slug = sluggify($store->name);
	}

	/**
	 * Handle the store "created" event.
	 *
	 * @return void
	 */
	public function created(Store $store)
	{
		//
	}

	/**
	 * Handle the store "updating" event.
	 *
	 * @return void
	 */
	public function updating(Store $store)
	{
		if ($store->isDirty('title')) {
			$store->slug = sluggify($store->title);
		}
	}

	/**
	 * Handle the store "updated" event.
	 *
	 * @return void
	 */
	public function updated(Store $store)
	{
		//
	}

	/**
	 * Handle the store "deleted" event.
	 *
	 * @return void
	 */
	public function deleted(Store $store)
	{
		//
	}

	/**
	 * Handle the store "restored" event.
	 *
	 * @return void
	 */
	public function restored(Store $store)
	{
		//
	}

	/**
	 * Handle the store "force deleted" event.
	 *
	 * @return void
	 */
	public function forceDeleted(Store $store)
	{
		//
	}
}
