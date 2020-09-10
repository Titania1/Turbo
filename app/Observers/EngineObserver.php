<?php

namespace App\Observers;

use App\Engine;

class EngineObserver
{
	/**
	 * Handle the engine "creating" event.
	 *
	 * @param \App\Engine $engine
	 * @return void
	 */
	public function creating(Engine $engine): void
	{
		$engine->slug = sluggify($engine->type);
	}

	/**
	 * Handle the engine "updating" event.
	 *
	 * @param \App\Engine $engine
	 * @return void
	 */
	public function updating(Engine $engine): void
	{
		if ($engine->isDirty('type')) {
			$engine->slug = sluggify($engine->type);
		}
	}
}
