<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class RoutesTest extends TestCase
{
	/**
	 * Test dev routes resolution.
	 *
	 * Asserts that the routes service provider
	 * resolve and maps the routes in dev under local env
	 *
	 * @return void
	 */
	public function test_dev_routes()
	{
		$response = $this->get('/mailable');

		$response->assertOk();
	}
}
