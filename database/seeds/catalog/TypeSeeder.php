<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Type;
use App\Category;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		// Get the sub categories
		$categories = Category::where('category_id', '!=', null)->select('id', 'internal_id')->get();
		foreach ($categories as $category) {
			$types = \DB::connection('tecdoc')
				->table('search_trees')
				->where('parent_node_id', $category->internal_id)
				->select('Description', 'tree_id', 'node_id')
				->get();
			foreach ($types as $type) {
				Type::create([
					'category_id' => $category->id,
					'internal_id' => $type->node_id,
					'tree_id' => $type->tree_id,
					'name' => $type->Description,
					'slug' => sluggify($type->Description),
				]);
			}
		}
	}
}
