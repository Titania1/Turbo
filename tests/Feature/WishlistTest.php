<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class WishlistTest extends TestCase
{
	/**
	 * Test wishlist index route.
	 */
	public function test_wishlist_index_page(): void
	{
		$response = $this->get('/wishlist');

		$response->assertOk();
	}
}
