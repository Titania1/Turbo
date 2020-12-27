<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\StoreContact.
 *
 * @property int                             $id
 * @property int                             $store_id
 * @property string|null                     $longitude
 * @property string|null                     $latitude
 * @property string|null                     $address
 * @property string|null                     $comment
 * @property string|null                     $email
 * @property string|null                     $phone
 * @property array|null                      $opening_hours
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Store $store
 *
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact query()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact whereOpeningHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreContact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StoreContact extends Model
{
    /**
     * The attributes that are spatial fields.
     *
     * @var array
     */
    protected $spatialFields = [
        'location',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'opening_hours' => 'array',
    ];

    /**
     * The store which the contact page belongs to.
     *
     * @return \App\Store $store
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
