<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$categories = \DB::connection('tecdoc')
			->table('search_trees')
			->where('parent_node_id', 0)
			->select('Description', 'tree_id', 'node_id')
			->get();
		foreach($categories->unique('Description') as $category){
			$parent_category = Category::create([
				'internal_id' => $category->node_id,
				'tree_id' => $category->tree_id,
				'name' => $category->Description,
				'slug' => sluggify($category->Description),
			]);
			$sub_categories = \DB::connection('tecdoc')
				->table('search_trees')
				->where('parent_node_id', $parent_category->internal_id)
				->select('Description', 'tree_id', 'node_id')
				->get();
			foreach ($sub_categories as $sub_category) {
				$model = Category::create([
					'category_id' => $parent_category->id,
					'internal_id' => $sub_category->node_id,
					'tree_id' => $sub_category->tree_id,
					'name' => $sub_category->Description,
					'slug' => sluggify($sub_category->Description),
				]);
				// https://autodatabases.ru/2q2018/img/sections/100121.png
				$response = Http::get("https://autodatabases.ru/2q2018/img/sections/$sub_category->node_id.png");
				if ($response->successful()) {
					Storage::disk('public')->put("/categories/$model->internal_id.png", $response->body());
					$model->image = "/categories/$model->internal_id.png";
					// Storage::disk('public')->put("/categories/$model->id.png", $response->body());
					// $model->image = "/categories/$model->id.png";
					$model->save();
				}
			}
		}
	}
}
