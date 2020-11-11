<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Brand.
 *
 * @property int                             $id
 * @property int|null                        $internal_id
 * @property string                          $name
 * @property string                          $logo
 * @property string|null                     $country
 * @property string                          $slug
 * @property int                             $is_commercial
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model[] $models
 * @property-read int|null $models_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Part[] $parts
 * @property-read int|null $parts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vehicle[] $vehicles
 * @property-read int|null $vehicles_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereInternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereIsCommercial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Brand extends Eloquent
{
	/**
	 * Get the value of the model's route key.
	 */
	public function getRouteKey(): string
	{
		return $this->id.'/'.$this->slug;
	}

	public function vehicles(): HasManyThrough
	{
		return $this->hasManyThrough(Vehicle::class, Model::class);
	}

	public function models(): HasMany
	{
		return $this->hasMany(Model::class);
	}

	public function engines(): HasMany
	{
		return $this->hasMany(Engine::class);
	}
}
