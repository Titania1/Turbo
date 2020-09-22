<?php

declare(strict_types=1);

use App\Part;
use App\User;
use App\Vehicle;
use App\Category;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// We need to seed parts for each main category
		// Limit main categories to 3
		// Each main category has many sub categories
		// Limit subcategories to 1
		// Each subcategory has many types
		// Limit types to 1
		// Seed 4 parts for each type
		// The goal is to get 3 types at the end
		$categories = Category::whereHas('subType')->limit(3)->select('id')
			->with('subType:types.id')->get()->map(function ($category) {
				return $category->subTypes()->limit(1)->pluck('types.id')->toArray();
			})->toArray();
		$vehicles = Vehicle::select('id')->limit(10)->pluck('id')->toArray();
		foreach ($categories as $types) { // 3 types
			foreach ($vehicles as $vehicle) { // 10 vehicles
				factory(Part::class, 2)->create([ // 60 parts
					'vehicle_id' => $vehicle,
					'type_id' => $types[0],
					'user_id' => rand(1, User::count()),
				])->each(fn ($part) => \Illuminate\Support\Facades\Redis::zincrby('popular_parts', rand(1, 100), $part->id));
			}
		}
	}
}
