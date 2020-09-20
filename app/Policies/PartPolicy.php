<?php

namespace App\Policies;

use App\Part;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartPolicy
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
     * @param  \App\Part  $part
     * @return mixed
     */
    public function view(User $user, Part $part)
    {
        return $user->hasPermissionTo('Read Parts');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Add Parts');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Part  $part
     * @return mixed
     */
    public function update(User $user, Part $part)
    {
        return $user->hasPermissionTo('Edit Parts');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Part  $part
     * @return mixed
     */
    public function delete(User $user, Part $part)
    {
        return $user->hasPermissionTo('Delet Parts');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Part  $part
     * @return mixed
     */
    public function restore(User $user, Part $part)
    {
        return $user->hasPermissionTo('Restore Parts');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Part  $part
     * @return mixed
     */
    public function forceDelete(User $user, Part $part)
    {
        return $user->hasPermissionTo('ForceDelete Parts');
    }
}
