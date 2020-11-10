<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Supplier.
 *
 * @property int                             $id
 * @property int                             $user_id
 * @property string                          $name
 * @property string                          $address
 * @property int                             $phone
 * @property float|null                      $credit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supplier whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supplier whereUserId($value)
 * @mixin \Eloquent
 *
 * @property int|null $owner_id
 * @property-read \App\User|null $owner
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereOwnerId($value)
 */
class Supplier extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
