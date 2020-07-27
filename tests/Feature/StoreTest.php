<?php

namespace Tests\Feature;

use App\Store;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
	use DatabaseMigrations;

    /**
     * Test store page
     *
     * @return void
     */
    public function test_store_page(): void
    {
		$user = create(User::class);
		$store = create(Store::class, ['user_id' => $user->id]);
        $response = $this->get(route('store', ['store' => $store]));

        $response->assertStatus(200);
    }
}
