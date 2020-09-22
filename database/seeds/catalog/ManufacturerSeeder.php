<?php

declare(strict_types=1);

use App\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ManufacturerSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Storage::disk('public')->deleteDirectory('brands');
		Storage::disk('public')->makeDirectory('brands');
		require_once dirname(__FILE__, 2) . '/data/brands.php';
		$this->seedManufacturers($manufacturers);
		$this->seedCommercialManufacturers($commercialVehicles);
	}

	private function seedManufacturers(array $manufacturers): void
	{
		// TODO: Dry this
		foreach ($manufacturers as $image_url => $name) {
			$this->create($name);
		}
	}

	private function seedCommercialManufacturers(array $manufacturers): void
	{
		// Seed commercial vehicles
		foreach ($manufacturers as $image_url => $name) {
			$this->create($name, true);
		}
	}

	private function create(string $name, bool $commercial = false): void
	{
		Brand::create([
			'name' => $name,
			'slug' => sluggify($name),
			'internal_id' => $this->getBrandId($name),
			'is_commercial' => $commercial,
		]);
	}

	// Use the name to grab the model from tecdoc using the brand name to get the id
	private function getBrandId(string $name): int
	{
		return \DB::connection('tecdoc')
			->table('manufacturers')
			->select('id')
			->where('MatchCode', $name)
			->orWhere('Description', $name)
			->limit(1)
			->pluck('id')
			->first();
	}
}
