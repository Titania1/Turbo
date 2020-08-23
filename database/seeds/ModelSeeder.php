<?php

declare(strict_types=1);

use App\Brand;
use App\VehicleModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ModelSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		Storage::disk('public')->deleteDirectory('models');
		Storage::disk('public')->makeDirectory('models');
		require_once dirname(__FILE__) . '/data/brands.php';
		foreach ($brands as $image_url => $name) {
			$this->seedModels($name);
		}
	}

	public function create($tecdoc_model, $brand_name): void
	{
		VehicleModel::create([
			'brand_id' => Brand::select('id')->where('name', $brand_name)->first()->id,
			'from' => $tecdoc_model->From,
			'to' => $tecdoc_model->To,
			'name' => $tecdoc_model->Description
		]);
	}

	public function seedModels(string $name): void
	{
		// We select the id of the model to use it to grab the image from ghiar
		// Use that id to grab the models from tecdoc
		$models = $this->getModelsByBrand($name);
		foreach ($models as $model) {
			// Create the model and insert it into DB
			$this->create($model, $name);
			$this->download($name, $model->id);
		}
	}

	public function download(string $name, int $id): void
	{
		$url = 'https://ghiar.com/images/modelsphotos/';
		// Download the model pic
		$response = Http::get($url . strtolower($name) . '/' . $id . '.jpg');
		// Store it locally
		Storage::disk('public')->put("/models/$id.jpg", $response->body());
	}

	// Use the name to grab the model from tecdoc using the brand name to get the id
	public function getBrandId(string $name): int
	{
		return \DB::connection('tecdoc')
			->table('manufacturers')
			->select('id')
			->where('Matchcode', $name)
			->limit(1)
			->pluck('id')
			->first();
	}

	public function getModelsByBrand(string $name): Collection
	{
		return \DB::connection('tecdoc')
			->table('models')
			->select('id', 'From', 'To', 'Description')
			->where('ManufacturerId', $this->getBrandId($name))
			->whereDate('To', '>', '1980-01-01')
			->get();
	}
}
