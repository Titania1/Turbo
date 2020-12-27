<?php

declare(strict_types=1);

namespace App\Seeders\Catalog;

use App\{Car, Engine};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarEngineSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// A car has many engines
		$cars = Car::select('id', 'internal_id')->get();
		$this->linkCars($cars);
	}

	private function linkCars($cars): void
	{
		foreach ($cars as $car) {
			$engine_ids = DB::connection('tecdoc')->table('passengercars_link_engines')
				->where('car_id', $car->internal_id)
				->select('engine_id')
				->pluck('engine_id')
				->toArray();
			$engines = Engine::whereIn('internal_id', $engine_ids)->select('id')->pluck('id')->toArray();
			$car->engines()->attach($engines);
		}
	}
}
