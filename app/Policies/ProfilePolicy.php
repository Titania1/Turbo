<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use App\Profile;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
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
	public function view(User $user, Profile $profile)
	{
		return $user->hasPermissionTo('Read Profiles');
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Profiles');
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Profile $profile)
	{
		return $user->hasPermissionTo('Edit Profiles');
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Profile $profile)
	{
		return $user->hasPermissionTo('Delete Profiles');
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Profile $profile)
	{
		return $user->hasPermissionTo('Restore Profiles');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Profile $profile)
	{
		return $user->hasPermissionTo('Force Delete Profiles');
	}
}
