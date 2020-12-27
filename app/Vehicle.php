<?php

declare(strict_types=1);

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Staudenmeir\EloquentHasManyDeep\{HasManyDeep, HasRelationships};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany};
/**
 * App\Vehicle.
 *
 * @property int                             $id
 * @property string                          $year
 * @property string                          $brand
 * @property string                          $model
 * @property string                          $fuel
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Part[] $parts
 * @property-read int|null $parts_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereFuel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereYear($value)
 * @mixin \Eloquent
 *
 * @property int|null    $internal_id
 * @property int         $model_id
 * @property string|null $from
 * @property string|null $to
 * @property string      $name
 * @property string      $slug
 * @property string|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Part[] $compatibileParts
 * @property-read int|null $compatibile_parts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Engine[] $engines
 * @property-read int|null $engines_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereInternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereTo($value)
 */
class Vehicle extends Eloquent
{
	use Searchable;
	use HasRelationships;

	public function model(): BelongsTo
	{
		return $this->belongsTo(Model::class);
	}

	/**
	 * Get the index name for the model.
	 */
	public function searchableAs(): string
	{
		return 'vehicles_index';
	}

	/**
	 * Get the indexable data array for the model.
	 */
	public function toSearchableArray(): array
	{
		$array = $this->only('brand', 'model', 'year', 'fuel');

		return $array;
	}

	/**
	 * Get the value used to index the model.
	 */
	public function getScoutKey(): string
	{
		return $this->model;
	}

	/**
	 * Get the key name used to index the model.
	 */
	public function getScoutKeyName(): string
	{
		return 'model';
	}

	/**
	 * Get parts of vehicle.
	 *
	 * Defines the hasMany relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany parts()
	 * @return mixed                                           \Illuminate\Database\Eloquent\Collection $parts
	 **/
	public function parts(): HasMany
	{
		return $this->hasMany(Part::class);
	}

	public function compatibileParts(): BelongsToMany
	{
		return $this->belongsToMany(Part::class);
	}

	public function cars(): HasMany
	{
		return $this->hasMany(Car::class);
	}

	public function engines(): HasManyDeep
	{
		return $this->hasManyDeep(Engine::class, [Car::class, 'car_engine']);
	}
}
