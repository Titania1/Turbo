<?php

namespace App\Policies;

use App\Nova\Bill;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPolicy
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
	 * @param  \App\Bill  $bill
	 * @return mixed
	 */
	public function view(User $user, Bill $bill)
	{
		return $user->hasPermissionTo('Read Bills');
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Bills');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Bill  $bill
	 * @return mixed
	 */
	public function update(User $user, Bill $bill)
	{
		return $user->hasPermissionTo('Edit Bills');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Bill  $bill
	 * @return mixed
	 */
	public function delete(User $user, Bill $bill)
	{
		return $user->hasPermissionTo('Delete Bills');
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Bill  $bill
	 * @return mixed
	 */
	public function restore(User $user, Bill $bill)
	{
		return $user->hasPermissionTo('Restore Bills');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Bill  $bill
	 * @return mixed
	 */
	public function forceDelete(User $user, Bill $bill)
	{
		return $user->hasPermissionTo('ForceDelete Bills');
	}
}
