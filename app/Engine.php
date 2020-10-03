<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Engine.
 *
 * @property int $id
 * @property int|null $internal_id
 * @property int $vehicle_id
 * @property string $type
 * @property string $slug
 * @property string $interval
 * @property string $power
 * @property string $capacity
 * @property string|null $construction
 * @property string|null $fuel
 * @property string|null $fuel_mixture
 * @property string|null $charge
 * @property string|null $cylinder_construction
 * @property string|null $engine_management
 * @property string|null $cooling_type
 * @property string|null $compression
 * @property string|null $torque
 * @property string|null $bore
 * @property string|null $stroke
 * @property int|null $cylinders
 * @property int|null $valves
 * @property int|null $bearings
 * @property string $motor_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CatalogCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Vehicle $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|Engine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Engine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Engine query()
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereBearings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereBore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereCompression($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereCoolingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereCylinderConstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereCylinders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereEngineManagement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereFuel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereFuelMixture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereInternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereMotorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine wherePower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereStroke($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereTorque($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereValves($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Engine whereVehicleId($value)
 * @mixin \Eloquent
 */
class Engine extends Model
{
	public function brand(): BelongsTo
	{
		return $this->belongsTo(Brand::class);
	}

	public function getRouteKey(): string
	{
		return $this->id . '/' . $this->slug;
	}

	public function cars(): BelongsToMany
	{
		return $this->belongsToMany(Car::class);
	}

	public function getTypeAttribute(): string
	{
		return $this->cars()->select('type')->first()->type;
	}
}
