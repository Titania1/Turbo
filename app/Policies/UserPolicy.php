<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user)
	{
		return $user->hasPermissionTo('Browse Users');
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * The user can view only themselves.
	 *
	 * @param \App\User $user the authenticated user
	 * @param \App\User $model the user eloquent model (subject)
	 *
	 * @return bool
	 */
	public function view(User $user, User $model)
	{
		return $user->is($model);
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, User $model)
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, User $model)
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, User $model)
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, User $model)
	{
		//
	}
}
