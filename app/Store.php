<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Store.
 *
 * @property int                             $id
 * @property int                             $user_id
 * @property string                          $name
 * @property string                          $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\StoreAbout|null $about
 * @property-read \App\StoreContact|null $contact
 * @property-read \App\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Store newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store query()
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUserId($value)
 * @mixin \Eloquent
 */
class Store extends Model
{
    /**
     * Get the user that owns the store.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo App\User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contact(): HasOne
    {
        return $this->hasOne(StoreContact::class);
    }

    public function about(): HasOne
    {
        return $this->hasOne(StoreAbout::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
