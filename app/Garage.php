<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
