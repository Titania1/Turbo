<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Brand;
use App\Model;
use App\Engine;
use App\Vehicle;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SearchTest extends TestCase
{
	public function setUp(): void
	{
		parent::setUp();
		Storage::disk('public')->deleteDirectory('brands');
		Storage::disk('public')->makeDirectory('brands');
	}

	/**
	 * Test users can search for parts
	 * of a given vehicle criteria.
	 *
	 * @return void
	 */
	public function test_vehicle_parts_search()
	{
		Vehicle::withoutSyncingToSearch(function () {
			$brand = factory(Brand::class)->create();
			$model = factory(Model::class)->create(['brand_id' => $brand->id]);
			$vehicle = factory(Vehicle::class)->create(['model_id' => $model->id]);
			$engine = factory(Engine::class)->create(['vehicle_id' => $vehicle->id]);
			$response = $this->post('/search', [
				'year' => $vehicle->from,
				'brand' => $brand->id,
				'model' => $model->id,
				'fuel' => $engine->fuel,
			]);
			$response->assertOk();
		});
	}
}
