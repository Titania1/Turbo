<?php

namespace App\Policies;

use App\Type;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypePolicy
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
	 * @param  \App\Type  $type
	 * @return mixed
	 */
	public function view(User $user, Type $type)
	{
		return $user->hasPermissionTo('Read Types');
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Types');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Type  $type
	 * @return mixed
	 */
	public function update(User $user, Type $type)
	{
		return $user->hasPermissionTo('Edit Types');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Type  $type
	 * @return mixed
	 */
	public function delete(User $user, Type $type)
	{
		return $user->hasPermissionTo('Delete Types');
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Type  $type
	 * @return mixed
	 */
	public function restore(User $user, Type $type)
	{
		return $user->hasPermissionTo('Restore Types');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Type  $type
	 * @return mixed
	 */
	public function forceDelete(User $user, Type $type)
	{
		return $user->hasPermissionTo('ForceDelete Types');
	}
}
