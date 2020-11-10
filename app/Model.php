<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Model.
 *
 * @property int $id
 * @property int|null $internal_id
 * @property int $brand_id
 * @property string $image
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Brand $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vehicle[] $vehicles
 * @property-read int|null $vehicles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Model newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Model newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Model query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereInternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Model extends Eloquent
{
	/**
	 * Get the value of the model's route key.
	 */
	public function getRouteKey(): string
	{
		return $this->id . '/' . $this->slug;
	}

	public function brand(): BelongsTo
	{
		return $this->belongsTo(Brand::class);
	}

	public function vehicles(): HasMany
	{
		return $this->hasMany(Vehicle::class);
	}
}
