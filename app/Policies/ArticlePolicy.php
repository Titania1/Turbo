<?php

declare(strict_types=1);

namespace App\Policies;

use App\Nova\Catalog\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
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
     *
     * @param \App\Article $article
     */
    public function view(User $user, Article $article)
    {
        return $user->hasPermissionTo('Browse Articles');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Add Articles');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Article $article
     */
    public function update(User $user, Article $article)
    {
        return $user->hasPermissionTo('Edit Articles');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Article $article
     */
    public function delete(User $user, Article $article)
    {
        return $user->hasPermissionTo('Delete Articles');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Article $article
     */
    public function restore(User $user, Article $article)
    {
        return $user->hasPermissionTo('Restore Articles');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Article $article
     */
    public function forceDelete(User $user, Article $article)
    {
        return $user->hasPermissionTo('Force Delete Articles');
    }
}
