<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Brand;
use Tests\TestCase;
use App\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CatalogModelTest extends TestCase
{
	use DatabaseMigrations;

	/**
	 * Test that we can create a catalog model
	 * And we can navigate to it.
	 */
	public function test_catalog_model_route(): void
	{
		Storage::disk('public')->deleteDirectory('brands');
		Storage::disk('public')->makeDirectory('brands');
		$brand = create(Brand::class);
		$model = create(Model::class, [], 'make')->toArray();
		$model = $brand->models()->create($model);
		$response = $this->get("/brands/$brand->id/$brand->slug/models/$model->id/$model->slug");

		$response->assertOk();
	}
}
