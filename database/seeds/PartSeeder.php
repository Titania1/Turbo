<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use App\{Category, Part, User, Vehicle};

class PartSeeder extends Seeder
{
	/**
	 * Seed parts.
	 */
	public function run(): void
	{
		$categories = Category::whereHas('subType')->limit(3)->select('id')
			->with('subType:types.id')->get()->map(function ($category) {
				return $category->subTypes()->limit(1)->pluck('types.id')->toArray();
			})->toArray();
		$vehicles = Vehicle::select('id')->limit(10)->pluck('id')->toArray();
		foreach ($categories as $types) { // 3 types
			foreach ($vehicles as $vehicle) { // 10 vehicles
				factory(Part::class, 2)->create([ // 60 parts
					'vehicle_id' => $vehicle,
					'type_id'    => $types[0],
					'user_id'    => rand(1, User::count()),
				])->each(fn ($part) => \Illuminate\Support\Facades\Redis::zincrby('popular_parts', rand(1, 100), $part->id));
			}
		}
	}
}
