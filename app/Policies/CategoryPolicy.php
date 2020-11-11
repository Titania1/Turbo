<?php

declare(strict_types=1);

namespace App\Policies;

use App\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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
	public function view(User $user, Category $category)
	{
		return $user->hasPermissionTo('Read Categories');
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Categories');
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Category $category)
	{
		return $user->hasPermissionTo('Edit Categories');
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Category $category)
	{
		return $user->hasPermissionTo('Delete Categories');
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Category $category)
	{
		return $user->hasPermissionTo('Restore Categories');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Category $category)
	{
		return $user->hasPermissionTo('Force Delete Categories');
	}
}
