<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Brand;
use App\Model;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ModelSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$this->prepareDirectory();
		$brands = Brand::select('id', 'internal_id', 'is_commercial', 'slug')->get();
		foreach ($brands as $brand) {
			$this->seedModelsOfBrand($brand);
		}
	}

	private function seedModelsOfBrand(Brand $brand): void
	{
		// We select the id of the model to use it to grab the image from ghiar
		// Use that id to grab the models from tecdoc
		$models = $this->getModelsByBrand($brand->internal_id);
		foreach ($models as $model) {
			try {
				$this->create($model, $brand);
			} catch (\Illuminate\Database\QueryException $ex) {
				// Do nothing, it's a duplicate
			}
		}
	}

	private function getModelsByBrand(int $id): Collection
	{
		return \DB::connection('tecdoc')
			->table('models')
			->select('Description')
			->where('ManufacturerId', $id)
			->where('CanBeDisplayed', 1)
			->get();
	}

	private function create(object $tecdoc_model, Brand $brand): void
	{
		$name = strtok($tecdoc_model->Description, ' ');
		$slug = sluggify($name);
		$path = "models/$brand->slug/$slug.jpg";
		if ($brand->is_commercial) {
			$src = 'data/models/commercial/' . $brand->slug . '_' . $slug . '.jpg';
		} else {
			$src = 'data/models/not_commercial/' . $brand->slug . '_' . $slug . '.jpg';
		}
		Model::create([
			'brand_id' => $brand->id,
			'name' => $name,
			'slug' => $slug,
			'image' => $path,
		]);
		Storage::disk('public')->makeDirectory("models/$brand->slug");
		try {
			copy(
				base_path($src),
				storage_path("app/public/$path")
			);
		} catch (Exception $ex) {
			// Do nothing, couldn't find file
		}
	}

	private function prepareDirectory(): void
	{
		Storage::disk('public')->deleteDirectory('models');
		Storage::disk('public')->makeDirectory('models');
	}
}
