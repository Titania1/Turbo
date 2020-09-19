<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use App\Brand;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
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
	public function view(User $user, Brand $brand)
	{
		return $user->hasPermissionTo('Read Brands');
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Brands');
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Brand $brand)
	{
		return $user->hasPermissionTo('Edit Brand');
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Brand $brand)
	{
		return ! $brand->vehicles()->exists();
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Brand $brand)
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Brand $brand)
	{
		//
	}
}
