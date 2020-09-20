<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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
	 * @param  \App\Order  $order
	 * @return mixed
	 */
	public function view(User $user, Order $order)
	{
		return $user->hasPermissionTo('Add Orders');
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Orders');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Order  $order
	 * @return mixed
	 */
	public function update(User $user, Order $order)
	{
		return $user->hasPermissionTo('Edit Orders');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Order  $order
	 * @return mixed
	 */
	public function delete(User $user, Order $order)
	{
		return $user->hasPermissionTo('Delete Orders');
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Order  $order
	 * @return mixed
	 */
	public function restore(User $user, Order $order)
	{
		return $user->hasPermissionTo('Restore Orders');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Order  $order
	 * @return mixed
	 */
	public function forceDelete(User $user, Order $order)
	{
		return $user->hasPermissionTo('ForceDelete Orders');
	}
}
