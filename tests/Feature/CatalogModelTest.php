<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Brand;
use App\VehicleModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CatalogModelTest extends TestCase
{
	use DatabaseMigrations;

	/**
	 * Test that we can create a catalog model
	 * And we can navigate to it
	 *
	 * @return void
	 */
	public function test_catalog_model_route(): void
	{
		$brand = create(Brand::class);
		$model = create(VehicleModel::class, [], 'make')->toArray();
		$model = $brand->models()->create($model);
		$response = $this->get(route('model', ['model' => $model]));

		$response->assertOk();
	}
}
