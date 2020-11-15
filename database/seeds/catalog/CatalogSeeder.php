<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the catalog database seeds.
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
            \App\Seeders\Catalog\BrandSeeder::class,
            \App\Seeders\Catalog\ModelSeeder::class,
            \App\Seeders\Catalog\VehicleSeeder::class,
            \App\Seeders\Catalog\CarSeeder::class,
            \App\Seeders\Catalog\EngineSeeder::class,
            \App\Seeders\Catalog\CarEngineSeeder::class,
            \App\Seeders\Catalog\CategorySeeder::class,
            \App\Seeders\Catalog\CarCategorySeeder::class,
            \App\Seeders\Catalog\ProductSeeder::class,
            \App\Seeders\Catalog\CategoryProductSeeder::class,
        ]);
    }

    /**
     * Clear search indexes.
     *
     * Calls scout flush artisan command
     *
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
            // 'categories',
            // 'types',
        ];
        foreach ($folders as $folder) {
            Storage::disk('public')->deleteDirectory($folder);
            Storage::disk('public')->makeDirectory($folder);
        }
    }
}
