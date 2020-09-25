<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Engine;
use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$engines = Engine::all();
		foreach ($engines as $engine) {
			$category_ids = \DB::connection('tecdoc')
				->table('tree_node_products')
				->where('itemId', $engine->internal_id)
				->where('valid_state', 1)
				->where('parent_node_id', 0)
				->select('node_id')
				->pluck('node_id')
				->toArray();
			foreach ($category_ids as $id) {
				$category = \DB::connection('tecdoc')
					->table('search_trees')
					->where('node_id', $id)
					->select('Description')
					->first();
				Category::create([
					'engine_id' => $engine->id,
					'internal_id' => $id,
					'name' => $category->Description,
					'slug' => sluggify($category->Description),
				]);
			}
		}
	}
}
