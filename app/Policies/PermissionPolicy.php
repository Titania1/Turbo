<?php

namespace App\Policies;

use App\Nova\Permission;
use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
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
	 * @param  \App\Permission  $permission
	 * @return mixed
	 */
	public function view(User $user, Permission $permission)
	{
		return $user->hasPermissionTo('Read Permissions');
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Permissions');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Permission  $permission
	 * @return mixed
	 */
	public function update(User $user, Permission $permission)
	{
		return $user->hasPermissionTo('Edit Permissions');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Permission  $permission
	 * @return mixed
	 */
	public function delete(User $user, Permission $permission)
	{
		return $user->hasPermissionTo('Delete Permissions');
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Permission  $permission
	 * @return mixed
	 */
	public function restore(User $user, Permission $permission)
	{
		return $user->hasPermissionTo('Restore Permissions');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Permission  $permission
	 * @return mixed
	 */
	public function forceDelete(User $user, Permission $permission)
	{
		return $user->hasPermissionTo('ForceDelete Permissions');
	}
}
