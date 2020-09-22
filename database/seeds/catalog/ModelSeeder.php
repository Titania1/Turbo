<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Brand;
use App\Model;
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
		$brands = Brand::select('id', 'internal_id')->get();
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
				$this->create($model, $brand->id);
			} catch (\Illuminate\Database\QueryException $ex) {
				// Do nothing, it's a duplicate
			}
		}
	}

	private function getModelsByBrand(int $id): Collection
	{
		return \DB::connection('tecdoc')
			->table('models')
			->select('id', 'Description')
			->where('ManufacturerId', $id)
			->get();
	}

	private function create(object $tecdoc_model, int $brand_id): int
	{
		$name = strtok($tecdoc_model->Description, ' ');
		return Model::create([
			'internal_id' => $tecdoc_model->id,
			'brand_id' => $brand_id,
			'name' => $name,
			'slug' => sluggify($name),
		])->id;
	}

	private function prepareDirectory(): void
	{
		Storage::disk('public')->deleteDirectory('models');
		Storage::disk('public')->makeDirectory('models');
	}
}
