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
		$this->prepareDirectory();
		require_once dirname(__FILE__) . '/data/brands.php';
		foreach ($brands as $image_url => $name) {
			$this->seedModels($name);
		}
	}

	public function create($tecdoc_model, $brand_name, $parent_id, $img): int
	{
		$to = ($tecdoc_model->To == '0000-00-00') ? null : $tecdoc_model->To;
		$from = ($tecdoc_model->From == '0000-00-00') ? null : $tecdoc_model->From;
		return VehicleModel::create([
			'brand_id' => Brand::select('id')->where('name', $brand_name)->first()->id,
			'from' => $from,
			'to' => $to,
			'name' => $tecdoc_model->Description,
			'vehicle_model_id' => $parent_id,
			'image' => $img
		])->id;
	}

	public function seedModels(string $name): void
	{
		// We select the id of the model to use it to grab the image from ghiar
		// Use that id to grab the models from tecdoc
		$models = $this->getModelsByBrand($name);
		foreach ($models as $model) {
			$havePic = $this->download($name, $model->id);
			if ($havePic) {
				$id = $this->create($model, $name, null, $model->id);
				$children = $this->getSubModels($name, $model->Description);
				foreach ($children as $child) {
					$this->create($child, $name, $id, null);
				}
			}
		}
	}

	// Download the model pic if available and store it locally
	public function download(string $name, int $id): bool
	{
		$url = 'https://ghiar.com/images/modelsphotos/';
		$response = Http::get($url . strtolower($name) . '/' . $id . '.jpg');
		if ($response->failed()) {
			return false;
		} else {
			Storage::disk('public')->put("/models/$id.jpg", $response->body());
			return true;
		}
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

	public function getSubModels(string $name, string $description): Collection
	{
		return \DB::connection('tecdoc')
			->table('models')
			->select('id', 'From', 'To', 'Description')
			->where('ManufacturerId', $this->getBrandId($name))
			->where('Description', '!=', $description)
			->where('Description', 'LIKE', strtok($description, ' ') . '%')
			->get();
	}

	public function getModelsByBrand(string $name): Collection
	{
		return \DB::connection('tecdoc')
			->table('models')
			->select('id', 'From', 'To', 'Description')
			->where('ManufacturerId', $this->getBrandId($name))
			->get();
	}

	public function prepareDirectory(): void
	{
		Storage::disk('public')->deleteDirectory('models');
		Storage::disk('public')->makeDirectory('models');
	}
}
