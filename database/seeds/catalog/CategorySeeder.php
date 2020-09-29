<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Client\RequestException;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$categories = $this->getCatalogCategories();
		foreach ($categories as $category) {
			$grand_father = $this->create($category);
			if ($grand_father) {
				$sub_categories = $this->getCatalogCategories($grand_father->internal_id);
				foreach ($sub_categories as $sub_category) {
					$father = $this->create($sub_category, $grand_father->id);
					if ($father) {
						$sub_sub_categories = $this->getCatalogCategories($father->internal_id);
						foreach ($sub_sub_categories as $kid) {
							$grand_kid = $this->create($kid, $father->id);
							if ($grand_kid) {
								$this->copyImage($grand_kid);
								$sub_sub_sub_categories = $this->getCatalogCategories($grand_kid->internal_id);
								foreach ($sub_sub_sub_categories as $baby) {
									$grand_grand_kid = $this->create($baby, $grand_kid->id);
									if ($grand_grand_kid) {
										$this->copyImage($grand_grand_kid);
									}
								}
							}
						}
					}
				}
			}
		}
	}

	/**
	 * undocumented function summary.
	 *
	 * Undocumented function long description
	 *
	 * @param int $parent_id Description
	 * @throws conditon
	 **/
	private function getCatalogCategories(int $parent_id = 0): Collection
	{
		return \DB::connection('tecdoc')
			->table('search_trees')
			->select('tree_id', 'node_id', 'Description')
			->where('parent_node_id', $parent_id)
			->get();
	}

	private function copyImage(Category $category)
	{
		$path = "app/public/categories/$category->id.png";
		try {
			copy(
				base_path("data/categories/$category->internal_id.png"),
				storage_path($path)
			);
			$category->image = $path;
			$category->save();
		} catch (\Exception $exception) {
			//
		}
	}

	private function downloadImage(Category $category): void
	{
		// https://autodatabases.ru/2q2018/img/sections/100121.png
		try {
			$response = Http::get("https://autodatabases.ru/2q2018/img/sections/$category->internal_id.png");
			// Illuminate\Http\Client\RequestException
			if ($response->successful()) {
				Storage::disk('public')->put("/categories/$category->internal_id.png", $response->body());
				$category->image = "/categories/$category->internal_id.png";
				// Storage::disk('public')->put("/categories/$category->id.png", $response->body());
				// $category->image = "/categories/$category->id.png";
				$category->save();
			}
		} catch (RequestException $exception) {
			$this->command->getOutput()
			->writeln("<comment>{$category->internal_id} {$exception->response->status()}.</comment>");
		}
	}

	private function create(object $category, $parent_id = null)
	{
		try {
			return Category::create([
				'category_id' => $parent_id,
				'internal_id' => $category->node_id,
				'tree_id' => $category->tree_id,
				'name' => $category->Description,
				'slug' => sluggify($category->Description),
			]);
		} catch (\Exception $ex) {
			return false;
		}
	}
}
