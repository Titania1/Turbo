<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use App\StoreAbout;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreAboutPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user)
	{
		//
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, StoreAbout $storeAbout)
	{
		//
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
	public function update(User $user, StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, StoreAbout $storeAbout)
	{
		//
	}
}
