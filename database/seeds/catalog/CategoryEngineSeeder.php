<?php

namespace App\Seeders;

use App\Category;
use App\Engine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryEngineSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		$engines = Engine::select('id', 'internal_id')->get();
		foreach ($engines as $engine) {
			$links = $this->getLinks($engine->internal_id);
			$categories = Category::whereIn('internal_id', $links)->select('id')->pluck('id')->toArray();
			$engine->categories()->attach($categories);
		}
	}

	private function getLinks(int $internal_id): array
	{
		return DB::connection('tecdoc')->table('tree_node_products')
			->select('node_id')
			->where('itemId', $internal_id)
			->where('valid_state', 1)
			->where('parent_node_id', 0)
			->distinct('node_id')
			->pluck('node_id')
			->toArray();
	}
}
