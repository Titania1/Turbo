<?php

namespace App\Policies;

use App\Invoice;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user)
	{
		return $user->hasRole('Super Admin');
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Invoice  $invoice
	 * @return mixed
	 */
	public function view(User $user, Invoice $invoice)
	{
		return $user->hasPermissionTo('Read Invoices');
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Invoices');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Invoice  $invoice
	 * @return mixed
	 */
	public function update(User $user, Invoice $invoice)
	{
		return $user->hasPermissionTo('Edit Invoices');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Invoice  $invoice
	 * @return mixed
	 */
	public function delete(User $user, Invoice $invoice)
	{
		return $user->hasPermissionTo('Delete Invoices');
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Invoice  $invoice
	 * @return mixed
	 */
	public function restore(User $user, Invoice $invoice)
	{
		return $user->hasPermissionTo('Restore Invoices');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Invoice  $invoice
	 * @return mixed
	 */
	public function forceDelete(User $user, Invoice $invoice)
	{
		return $user->hasPermissionTo('ForceDelete Invoices');
	}
}
