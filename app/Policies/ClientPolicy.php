<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientsPolicy
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

	 * @return mixed
	 */
	public function view(User $user)
	{
		return $user->hasPermissionTo('Read Clients');
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{

		return $user->hasPermissionTo('Add Clients');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user

	 * @return mixed
	 */
	public function update(User $user)
	{
		return $user->hasPermissionTo('Edit Clients');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\User  $user

	 * @return mixed
	 */
	public function delete(User $user)
	{
		return $user->hasPermissionTo('Delete Clients');
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param  \App\User  $user

	 * @return mixed
	 */
	public function restore(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param  \App\User  $user

	 * @return mixed
	 */
	public function forceDelete(User $user)
	{
		//
	}
}
