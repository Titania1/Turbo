<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
	/**
	 * Run the catalog database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		// Flush the redis cache to prevent seeing old data
		\Illuminate\Support\Facades\Redis::flushall();
		$this->clearSearchIndexes();
		$this->cleanupStorage();
		$this->callSeeders();
	}

	private function callSeeders(): void
	{
		$this->call([
			\App\Seeders\BrandSeeder::class,
			\App\Seeders\ModelSeeder::class,
			\App\Seeders\VehicleSeeder::class,
			\App\Seeders\CarSeeder::class,
			\App\Seeders\EngineSeeder::class,
			\App\Seeders\CarEngineSeeder::class,
			\App\Seeders\CategorySeeder::class,
			\App\Seeders\CarCategorySeeder::class,
			\App\Seeders\ProductSeeder::class,
			\App\Seeders\CategoryProductSeeder::class,
		]);
	}

	/**
	 * Clear search indexes.
	 *
	 * Calls scout flush artisan command
	 *
	 * @return void
	 **/
	private function clearSearchIndexes(): void
	{
		Artisan::call('scout:flush App\\\Vehicle');
		Artisan::call('scout:flush App\\\Part');
	}

	/**
	 * Cleanup storage before seeding.
	 *
	 * Delete and recreate storage directories
	 *
	 **/
	private function cleanupStorage(): void
	{
		$folders = [
			'avatars',
			'brands',
			'categories',
			'parts',
			'types',
		];
		foreach ($folders as $folder) {
			Storage::disk('public')->deleteDirectory($folder);
			Storage::disk('public')->makeDirectory($folder);
		}
	}
}
