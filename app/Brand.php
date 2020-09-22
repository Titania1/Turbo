<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Brand extends Eloquent
{
	/**
	 * Get the value of the model's route key.
	 */
	public function getRouteKey()
	{
		return $this->id . '/' . $this->slug;
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
		return $this->hasMany(Model::class);
	}
}
