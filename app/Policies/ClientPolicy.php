<?php

namespace App\Policies;

use App\Client;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
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
	 * @param  \App\Client  $client
	 * @return mixed
	 */
	public function view(User $user, Client $client)
	{
		return $user->hasPermissionTo('Read Clients');
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermissionTo('Add Clients');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Client  $client
	 * @return mixed
	 */
	public function update(User $user, Client $client)
	{
		return $user->hasPermissionTo('Edit Clients');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Client  $client
	 * @return mixed
	 */
	public function delete(User $user, Client $client)
	{
		return $user->hasPermissionTo('Delete Clients');
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Client  $client
	 * @return mixed
	 */
	public function restore(User $user, Client $client)
	{
		return $user->hasPermissionTo('Restore Clients');
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Client  $client
	 * @return mixed
	 */
	public function forceDelete(User $user, Client $client)
	{
		return $user->hasPermissionTo('ForceDelete Clients');
	}
}
