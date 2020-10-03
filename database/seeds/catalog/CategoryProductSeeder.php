<?php

namespace App\Seeders;

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
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
			->where('valid_state', 1)->where('itemId', $internal_id)
			->where('product_id', '!=', 0)
			->select('product_id')
			->distinct('product_id')
			->pluck('product_id')
			->toArray();
	}
}
