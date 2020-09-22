<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Brand;
use App\Model;
use App\Engine;
use App\Vehicle;

class EnginesController extends Controller
{
	/**
	 * Display the specified resource.
	 *
	 * @param \App\Brand $brand The Brand model or ID
	 * @param string $brand_slug The brand slug (optional)
	 * @param \App\Model $model The vehicles grouping model
	 * @param string|null $model_slug The model slug
	 * @param \App\Vehicle $vehicle The vehicle model or ID
	 * @param string|null $vehicle_slug The vehicle slug
	 * @param \App\Engine $engine The engine model or ID
	 * @param string|null $slug The engine slug
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Brand $brand, string $brand_slug = null, Model $model, string $model_slug = null, Vehicle $vehicle, string $vehicle_slug = null, Engine $engine, string $slug = null)
	{
		if ($brand_slug != $brand->slug || $model_slug != $model->slug || $slug != $vehicle->slug) {
			return redirect()->route('engine', [
				$brand->id,
				$brand->slug,
				$model->id,
				$model->slug,
				$vehicle->id,
				$vehicle->slug,
				$engine->id,
				$engine->slug,
			]);
		}

		return $model;
		$engines = $model->engines;

		return view('model', compact('engines', 'model'));
	}
}
