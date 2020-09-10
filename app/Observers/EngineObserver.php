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
		$engine->slug = sluggify($engine->type);
	}

	/**
	 * Handle the engine "updating" event.
	 */
	public function updating(Engine $engine): void
	{
		if ($engine->isDirty('type')) {
			$engine->slug = sluggify($engine->type);
		}
	}
}
