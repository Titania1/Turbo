<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Model;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class VehicleTest extends TestCase
{	/**
	 * A basic unit test example.
	 *
	 * @return void
	 */
	public function testExample()
	{
		$model = new Model();
		$this->assertInstanceOf(Collection::class, $model->vehicles);
		$this->assertTrue(true);
	}
}
