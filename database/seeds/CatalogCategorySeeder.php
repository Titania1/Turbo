<?php

declare(strict_types=1);

use App\Engine;
use App\CatalogCategory;
use Illuminate\Database\Seeder;

class CatalogCategorySeeder extends Seeder
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
			// $car_id = 50864
			$car_id = DB::connection('tecdoc')
				->table('passengercars')
				->where('Description', $engine->type)
				// 345
				->where('Model', $engine->model->image)
				->select('id')
				->first()
				->id;
			$engine_id = DB::connection('tecdoc')
				->table('passengercars_link_engines')
				->where('car_id', $car_id)
				->select('engine_id')
				->first()
				->engine_id;
			// $engine_id = 26422
			$category_ids = DB::connection('tecdoc')
				->table('tree_node_products')
				->where('itemId', $engine_id)
				->where('valid_state', 1)
				->where('parent_node_id', 0)
				->select('node_id')
				->pluck('node_id')
				->toArray();
			// $category_ids = 100008
			foreach ($category_ids as $id) {
				$category = DB::connection('tecdoc')
					->table('search_trees')
					->where('node_id', $id)
					->select('Description')
					->first();
				$img = $this->download($id);
				CatalogCategory::create([
					'engine_id' => $engine->id,
					'internal_id' => $id,
					'name' => $category->Description,
					'image' => $img ? 'categories/' . $id . '.png' : null,
					'slug' => sluggify($category->Description),
				]);
			}
		}
	}

	// Download the category pic if available and store it locally
	public function download(int $id): bool
	{
		$url = 'https://ghiar.com/images/catslogos/';
		$response = Http::get($url . $id . '.png');
		if ($response->failed()) {
			return false;
		} else {
			Storage::disk('public')->put("/categories/$id.png", $response->body());

			return true;
		}
	}
}
