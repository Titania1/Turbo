<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function vehicles()
	{
		return $this->hasMany(Vehicle::class);
	}

	public function parts()
	{
		return $this->hasManyThrough(Part::class, Vehicle::class);
	}

	public function models()
	{
		return $this->hasMany(VehicleModel::class)->whereNull('vehicle_model_id');
	}
}
