<?php

declare(strict_types=1);

namespace App\Policies;

use App\Type;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypePolicy
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
    public function view(User $user, Type $type)
    {
        return $user->hasPermissionTo('Read Types');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Add Types');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Type $type)
    {
        return $user->hasPermissionTo('Edit Types');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Type $type)
    {
        return $user->hasPermissionTo('Delete Types');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Type $type)
    {
        return $user->hasPermissionTo('Restore Types');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Type $type)
    {
        return $user->hasPermissionTo('Force Delete Types');
    }
}
