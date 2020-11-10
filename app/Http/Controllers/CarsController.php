<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Car;
use App\Brand;
use App\Model;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarsController extends Controller
{
	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Brand $brand, string $brand_slug = null, Model $model, string $model_slug = null, Vehicle $vehicle, string $vehicle_slug = null, Car $car, string $slug = null) : View
	{
		if ($brand_slug != $brand->slug || $model_slug != $model->slug || $vehicle_slug != $vehicle->slug || $slug != $car->slug) {
			return redirect()->route('car', [
				$brand->id,
				$brand->slug,
				$model->id,
				$model->slug,
				$vehicle->id,
				$vehicle->slug,
				$car->id,
				$car->slug,
			]);
		}

		$engines = $car->engines()->paginate(16);

		return view('car', compact('brand', 'model', 'vehicle', 'car', 'engines'));
	}

	public function getCarsByVehicle(Request $request) : Vehicle
	{
		return Vehicle::find($request->vehicle)->cars()->select('id', 'type')->get();
	}
}
