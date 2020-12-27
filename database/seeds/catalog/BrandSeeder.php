<?php

declare(strict_types=1);

namespace App\Seeders\Catalog;

use App\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('public')->deleteDirectory('brands');
        Storage::disk('public')->makeDirectory('brands');
        require_once dirname(__FILE__, 2).'/data/demo.php';
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
        $id = $this->getBrandId($name);
        $slug = sluggify($name);
        copy(
            base_path("data/brands/$name.jpg"),
            storage_path("app/public/brands/$slug.jpg")
        );
        Brand::create([
            'name'          => $name,
            'slug'          => $slug,
            'internal_id'   => $id,
            'is_commercial' => $commercial,
            'logo'          => "brands/$slug.jpg",
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
