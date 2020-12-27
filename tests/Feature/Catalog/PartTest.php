<?php

declare(strict_types=1);

namespace Tests\Feature\Catalog;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use App\{Brand, Model, Part, User, Vehicle};
use Illuminate\Foundation\Testing\RefreshDatabase;

class PartTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * Test part view and route.
	 */
	public function test_we_can_view_a_part(): void
	{
		Storage::disk('public')->makeDirectory('brands');
		Storage::disk('public')->makeDirectory('parts');
		Storage::disk('public')->makeDirectory('categories');
		Storage::disk('public')->makeDirectory('types');
		$user = create(User::class);
		$brand = create(Brand::class);
		$model = create(Model::class, ['brand_id' => $brand->id]);
		$vehicle = create(Vehicle::class, ['model_id' => $model->id]);
		$part = create(Part::class, [
			'user_id'    => $user->id,
			'vehicle_id' => $vehicle->id,
		]);
		$response = $this->get(route('part', ['part' => $part]));

		$response->assertStatus(200);
	}
}
