<?php

namespace Tests\Feature;

use App\Brand;
use App\VehicleModel;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandTest extends TestCase
{
	use DatabaseMigrations, RefreshDatabase;

	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function testExample()
	{
		$brand = create(Brand::class);
		$brand->models()->createMany(
			create(VehicleModel::class, [], 'make', 2)->toArray()
		);
		dd(create(VehicleModel::class, [], 'make', 2)->toArray());
		$this->assertInstanceOf(Collection::class, $brand->models);
		$response = $this->get(route('brand', $brand));
		$response->assertSee($brand->name);
		$response->assertStatus(200);
	}
}
