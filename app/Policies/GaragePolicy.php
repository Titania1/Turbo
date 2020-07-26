<?php

namespace App\Policies;

use App\User;
use App\Garage;
use Illuminate\Auth\Access\HandlesAuthorization;

class GaragePolicy
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
		return $user->can('View Garage');
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Garage  $garage
	 * @return mixed
	 */
	public function view(User $user, Garage $garage)
	{
		return $user->garage->id == $garage->id;
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Garage  $garage
	 * @return mixed
	 */
	public function update(User $user, Garage $garage)
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Garage  $garage
	 * @return mixed
	 */
	public function delete(User $user, Garage $garage)
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Garage  $garage
	 * @return mixed
	 */
	public function restore(User $user, Garage $garage)
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Garage  $garage
	 * @return mixed
	 */
	public function forceDelete(User $user, Garage $garage)
	{
		//
	}
}
