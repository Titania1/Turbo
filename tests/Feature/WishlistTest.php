<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WishlistTest extends TestCase
{
	use DatabaseMigrations;

	/**
	 * Test wishlist index route.
	 *
	 * @return void
	 */
	public function test_wishlist_index_page(): void
	{
		$response = $this->get('/wishlist');

		$response->assertOk();
	}
}
