<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Part;
use App\User;
use App\Product;
use App\Vehicle;
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartSeeder extends Seeder
{
	/**
	 * Seed parts.
	 */
	public function run(): void
	{
		// Seed articles belonging to each category
		// articles table in tecdoc containing 6 million records
		DB::connection('tecdoc')->table('articles') // Construct query
			// remove 999059 records
			->where('IsValid', 1) // Narrow down to valid (from 6722202 to 5723143)
			->select('DataSupplierArticleNumber', 'NormalizedDescription')
			->get(); // Select necessary data
		// The searchable parts should be in the products table
		// We may not be able to use Algolia for searching by SKU
		// Parts table should contain what the products table contains
		$parts = DB::connection('tecdoc')
			->table('products')
			->select('Description')
			->distinct('Description')
			->get();
		foreach ($parts as $part) {
			Product::create(['name' => $part->Description]);
		}
		// $categories = Category::whereHas('subType')->limit(3)->select('id')
		// 	->with('subType:types.id')->get()->map(function ($category) {
		// 		return $category->subTypes()->limit(1)->pluck('types.id')->toArray();
		// 	})->toArray();
		// $vehicles = Vehicle::select('id')->limit(10)->pluck('id')->toArray();
		// foreach ($categories as $types) { // 3 types
		// 	foreach ($vehicles as $vehicle) { // 10 vehicles
		// 		factory(Part::class, 2)->create([ // 60 parts
		// 			'vehicle_id' => $vehicle,
		// 			'type_id' => $types[0],
		// 			'user_id' => rand(1, User::count()),
		// 		])->each(fn ($part) => \Illuminate\Support\Facades\Redis::zincrby('popular_parts', rand(1, 100), $part->id));
		// 	}
		// }
	}
}
