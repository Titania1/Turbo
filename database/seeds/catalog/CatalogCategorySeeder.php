<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Engine;
use App\CatalogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
			$car_id = \DB::connection('tecdoc')
				->table('passengercars')
				->where('Description', $engine->type)
				// 345
				->where('Model', $engine->model->image)
				->select('id')
				->first()
				->id;
			$engine_id = \DB::connection('tecdoc')
				->table('passengercars_link_engines')
				->where('car_id', $car_id)
				->select('engine_id')
				->first()
				->engine_id;
			// $engine_id = 26422
			$category_ids = \DB::connection('tecdoc')
				->table('tree_node_products')
				->where('itemId', $engine_id)
				->where('valid_state', 1)
				->where('parent_node_id', 0)
				->select('node_id')
				->pluck('node_id')
				->toArray();
			// $category_ids = 100008
			foreach ($category_ids as $id) {
				$category = \DB::connection('tecdoc')
					->table('search_trees')
					->where('node_id', $id)
					->select('Description')
					->first();
				// 300001, 300001, 300001, 300002, 300019, 300020, 300020, 300021, 300021, 300016, 300022, 301865, 300023, 300023, 302283, 300055, 300064, 300075, 300083, 302652, 301218, 302321, 301968, 301972, 303135, 303135, 706172, 100001, 100002, 100005, 100016, 100214, 100254, 100004, 100007, 100050, 100238, 100014, 100400, 100006, 100011, 100013, 100012, 100010, 100008, 100241, 100243, 100019, 100015, 100018, 100341, 100733, 706365, 200022, 200026, 200047, 200048, 200049, 200050, 200051, 200052, 200053, 200054, 200056, 200058, 200059, 200060, 200061, 200062, 200063, 200064, 200065, 200066, 200067, 200958, 200987, 203517, 706178
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
