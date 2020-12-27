<?php

declare(strict_types=1);

namespace App\Policies;

use App\Store;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StorePolicy
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
    public function view(User $user, Store $store)
    {
        return ($user->id == $store->user_id) || $user->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasRole('Super Admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Store $store)
    {
        return (bool) $user->id == $store->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Store $store)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Store $store)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Store $store)
    {
        return false;
    }
}
