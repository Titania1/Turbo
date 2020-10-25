<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Brand;
use App\Vehicle;

use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$brands = Brand::all();
		foreach ($brands as $brand) {
			factory(Vehicle::class, 2)->create(['brand_id' => $brand->id]);
		}
	}
}


