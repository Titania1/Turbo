<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
	/**
	 * Get the user that owns the store.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo App\User
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function contact(): HasOne
	{
		return $this->hasOne(StoreContact::class);
	}

	public function about(): HasOne
	{
		return $this->hasOne(StoreAbout::class);
	}

	/**
	 * Get the route key for the model.
	 */
	public function getRouteKeyName(): string
	{
		return 'slug';
	}
}
