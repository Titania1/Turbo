<?php

declare(strict_types=1);

namespace Tests\Feature\Stock;

use App\Store;
use App\User;
use Tests\TestCase;

class StoreTest extends TestCase
{
	/**
	 * Test store page.
	 */
	public function test_store_page(): void
	{
		$user = create(User::class);
		$store = create(Store::class, ['user_id' => $user->id]);
		$response = $this->get(route('store', ['store' => $store]));

		$response->assertStatus(200);
	}
}
