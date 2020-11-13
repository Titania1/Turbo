<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Stock.
 *
 * @property int                             $id
 * @property int                             $user_id
 * @property int                             $part_id
 * @property int                             $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Part $part
 * @property-read \App\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock wherePartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUserId($value)
 * @mixin \Eloquent
 */
class Stock extends Model
{
    /**
     * Get the part that owns the stock.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo App\Part
     */
    public function part(): BelongsTo
    {
        return $this->belongsTo(Part::class);
    }

    /**
     * Get the user that owns the stock.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo App\User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
