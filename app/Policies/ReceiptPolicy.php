<?php

declare(strict_types=1);

namespace App\Policies;

use App\{Receipt, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class ReceiptPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user)
	{
		return $user->hasRole('Super Admin');
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Receipt $receipt)
	{
		return $user->hasPermissionTo('Read Receipts');
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Receipts');
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Receipt $receipt)
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Receipt $receipt)
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Receipt $receipt)
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Receipt $receipt)
	{
		//
	}
}
