<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
	public function model()
	{
		return $this->belongsTo(VehicleModel::class, 'vehicle_model_id');
	}

	public function getRouteKeyName(): string
	{
		return 'slug';
	}
}
