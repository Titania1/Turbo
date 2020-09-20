<?php

declare(strict_types=1);

namespace App\Policies;

use App\Part;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartPolicy
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
	public function view(User $user, Part $part)
	{
		return $user->hasPermissionTo('Read Parts');
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Parts');
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Part $part)
	{
		return $user->hasPermissionTo('Edit Parts');
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Part $part)
	{
		return $user->hasPermissionTo('Delet Parts');
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Part $part)
	{
		return $user->hasPermissionTo('Restore Parts');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Part $part)
	{
		return $user->hasPermissionTo('ForceDelete Parts');
	}
}
