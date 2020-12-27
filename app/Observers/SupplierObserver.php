<?php

declare(strict_types=1);

namespace App\Observers;

use App\Supplier;

class SupplierObserver
{
	/**
	 * Handle the supplier "creating" event.
	 *
	 * @return void
	 */
	public function creating(Supplier $supplier)
	{
		auth()->check() ? $supplier->owner_id = auth()->id() : '';
	}

	/**
	 * Handle the supplier "created" event.
	 *
	 * @return void
	 */
	public function created(Supplier $supplier)
	{
		//
	}

	/**
	 * Handle the supplier "updated" event.
	 *
	 * @return void
	 */
	public function updated(Supplier $supplier)
	{
		//
	}

	/**
	 * Handle the supplier "deleted" event.
	 *
	 * @return void
	 */
	public function deleted(Supplier $supplier)
	{
		//
	}

	/**
	 * Handle the supplier "restored" event.
	 *
	 * @return void
	 */
	public function restored(Supplier $supplier)
	{
		//
	}

	/**
	 * Handle the supplier "force deleted" event.
	 *
	 * @return void
	 */
	public function forceDeleted(Supplier $supplier)
	{
		//
	}
}
