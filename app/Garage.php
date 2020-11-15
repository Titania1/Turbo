<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Garage.
 *
 * @property int                             $id
 * @property int                             $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vehicle[] $vehicles
 * @property-read int|null $vehicles_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Garage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Garage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Garage query()
 * @method static \Illuminate\Database\Eloquent\Builder|Garage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Garage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Garage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Garage whereUserId($value)
 * @mixin \Eloquent
 */
class Garage extends Model
{
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function vehicles(): BelongsToMany
	{
		return $this->belongsToMany(Vehicle::class);
	}
}
