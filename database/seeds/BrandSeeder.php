<?php

declare(strict_types=1);

use App\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BrandSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Storage::disk('public')->deleteDirectory('brands');
		Storage::disk('public')->makeDirectory('brands');
		require_once dirname(__FILE__) . '/data/brands.php';
		foreach ($brands as $image_url => $name) {
			$response = Http::get('https://ghiar.com/' . $image_url);
			Storage::disk('public')->put("/brands/$name.png", $response->body());
			Brand::create([
				'name' => $name,
				'logo' => "brands/$name.png",
			]);
		}
	}
}
