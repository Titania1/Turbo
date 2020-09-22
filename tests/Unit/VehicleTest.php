<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\VehicleModel;
use PHPUnit\Framework\TestCase;
use Illuminate\Database\Eloquent\Collection;

class VehicleTest extends TestCase
{
	/**
	 * A basic unit test example.
	 *
	 * @return void
	 */
	public function testExample()
	{
		$vehicle = new VehicleModel();
		$this->assertInstanceOf(Collection::class, $vehicle->children);
		$this->assertTrue(true);
	}
}
