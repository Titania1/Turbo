<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Category;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		// Get the catalog categories without a parent
		$main_categories = $this->getCatalogCategories();
		// Create each one via eloquent
		foreach ($main_categories as $main_category) {
			$category = $this->create($main_category);
			// Get catalog sub_categories
			$sub_categories = $this->getCatalogCategories($main_category->node_id);
			foreach ($sub_categories as $sub_category) {
				$this->create($sub_category, $category->id);
			}
		}
	}

	/**
	 * Get catalog categories.
	 *
	 * Fetches search trees for categories
	 *
	 * @param int $parent_id parent_node_id i.e parent category (0 is null)
	 * @throws conditon
	 **/
	private function getCatalogCategories(int $parent_id = 0): Collection
	{
		return DB::connection('tecdoc')
			->table('search_trees')
			->where('parent_node_id', $parent_id)
			->where('tree_id', 1)
			->select('node_id', 'Description')
			->get();
	}

	private function create(object $category, $parent_id = null): Category
	{
		return Category::create([
			'category_id' => $parent_id,
			'internal_id' => $category->node_id,
			'name' => $category->Description,
			'slug' => sluggify($category->Description),
		]);
	}
}
