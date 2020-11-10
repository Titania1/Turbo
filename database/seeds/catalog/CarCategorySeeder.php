<?php

declare(strict_types=1);

namespace App\Seeders\Catalog;

use App\Car;
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = Car::select('id', 'internal_id')->get();
        // Get all categories using car internal_id
        foreach ($cars as $car) {
            // Get catalog links
            $links = $this->getLinks($car->internal_id);
            // Get matching local categories
            $categories = Category::whereIn('internal_id', $links)->select('id')->pluck('id')->toArray();
            // Attach the categories
            $car->categories()->attach($categories);
        }
    }

    private function getLinks(int $internal_id): array
    {
        return DB::connection('tecdoc')->table('tree_node_products')
            ->select('node_id')
            ->where('itemId', $internal_id)
            ->where('valid_state', 1)
            ->pluck('node_id')
            ->toArray();
    }
}
