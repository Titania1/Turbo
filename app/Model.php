<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
	/**
	 * Get the value of the model's route key.
	 *
	 * @return mixed
	 */
	public function getRouteKey()
	{
		return $this->id . '/' . $this->slug;
	}

	public function vehicles()
	{
		return $this->hasMany(Vehicle::class);
	}
}
