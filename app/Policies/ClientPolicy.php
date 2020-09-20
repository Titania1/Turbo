<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use App\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
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
	public function view(User $user, Client $client)
	{
		return $user->hasPermissionTo('Read Clients');
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Clients');
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Client $client)
	{
		return $user->hasPermissionTo('Edit Clients');
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, Client $client)
	{
		return $user->hasPermissionTo('Delete Clients');
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Client $client)
	{
		return $user->hasPermissionTo('Restore Clients');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Client $client)
	{
		return $user->hasPermissionTo('Force Delete Clients');
	}
}
