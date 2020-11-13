<?php

declare(strict_types=1);

namespace App\Seeders\Catalog;

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$categories = Category::select('id', 'internal_id')->get();
		foreach ($categories as $category) {
			$product_ids = $this->getProductIds($category->internal_id);
			$category->products()->attach($product_ids);
		}
	}

	private function getProductIds(int $internal_id): array
	{
		return DB::connection('tecdoc')->table('tree_node_products')
			->where('itemId', $internal_id)
			->where('valid_state', 1)
			->where('tree_id', 1)
			->where('product_id', '!=', 0)
			->select('product_id')
			->distinct('product_id')
			->pluck('product_id')
			->toArray();
	}
}
