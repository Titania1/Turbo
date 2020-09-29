<?php

declare(strict_types=1);

namespace App\Observers;

use App\Engine;

class EngineObserver
{
	/**
	 * Handle the engine "creating" event.
	 */
	public function creating(Engine $engine): void
	{
		$engine->slug = sluggify($engine->motor_code);
	}

	/**
	 * Handle the engine "updating" event.
	 */
	public function updating(Engine $engine): void
	{
		if ($engine->isDirty('motor_code')) {
			$engine->slug = sluggify($engine->motor_code);
		}
	}
}
