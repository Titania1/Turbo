<?php

use Illuminate\Database\Seeder;
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
			// Use the name to grab the model from tecdoc using the brand name to get the id
			$ManufacturerId = \DB::connection('tecdoc')->table('manufacturers')
				->select('id')->where('Matchcode', $name)->limit(1)->pluck('id')->first();
			// We select the id of the model to use it to grab the image from ghiar
			$models = \DB::connection('tecdoc')->table('models')
				->select('id', 'From', 'To', 'Description')
				->where('ManufacturerId', $ManufacturerId)->whereDate('To', '>', '1980-01-01')->get();
			// Use that id to grab the models from tecdoc
			$response = Http::get('https://ghiar.com/' . $image_url);
			Storage::disk('public')->put("/brands/$name.png", $response->body());
			//
		}
	}
}
