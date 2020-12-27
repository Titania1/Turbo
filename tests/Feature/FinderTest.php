<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\{Brand, Model, Vehicle};
use Illuminate\Support\Facades\Storage;

class FinderTest extends TestCase
{
	public function setUp(): void
	{
		parent::setUp();
		Storage::disk('public')->deleteDirectory('brands');
		Storage::disk('public')->makeDirectory('brands');
	}

	/**
	 * Test get brands by year.
	 *
	 * Assert correct API response
	 *
	 * @return void
	 */
	public function test_brands_by_year()
	{
		$brand = factory(Brand::class)->create();
		$model = factory(Model::class)->create(['brand_id' => $brand->id]);
		$vehicle = factory(Vehicle::class)->create(['model_id' => $model->id]);
		$response = $this->post('/api/getYearBrands', [
			'year' => $vehicle->from,
		]);
		$response->assertOk();
	}
}
