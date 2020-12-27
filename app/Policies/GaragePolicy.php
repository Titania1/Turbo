<?php

declare(strict_types=1);

namespace App\Policies;

use App\{Garage, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class GaragePolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user)
	{
		return $user->can('View Garage');
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Garage $garage)
	{
		return $user->garage->id == $garage->id;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Garages');
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Garage $garage)
	{
		return $user->hasPermissionTo('Edit Garages');
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Garage $garage)
	{
		return $user->hasPermissionTo('Delete Garages');
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Garage $garage)
	{
		return $user->hasPermissionTo('Restore Garages');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Garage $garage)
	{
		return $user->hasPermissionTo('Force Delete Garages');
	}
}
