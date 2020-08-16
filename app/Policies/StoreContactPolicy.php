<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use App\StoreContact;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreContactPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user)
	{
		return $user->store;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, StoreContact $storeContact)
	{
		return $storeContact->store_id == $user->store->id;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user)
	{
		return !optional(optional($user->store)->has('contact'))->exists();
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, StoreContact $storeContact)
	{
		return $storeContact->store_id == $user->store->id;
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, StoreContact $storeContact)
	{
		return false;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, StoreContact $storeContact)
	{
		return false;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, StoreContact $storeContact)
	{
		return false;
	}
}
