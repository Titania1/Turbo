<?php

declare(strict_types=1);

namespace Tests\Feature\Catalog;

use Tests\TestCase;

class EngineTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	public function testExample(): void
	{
		$this->withoutExceptionHandling();
		$response = $this->get('/');

		$response->assertStatus(200);
	}
}
