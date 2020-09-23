<?php

declare(strict_types=1);

namespace Tests\Feature\Catalog;

use App\Part;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class PartTest extends TestCase
{
	/**
	 * Test part view and route.
	 */
	public function test_we_can_view_a_part(): void
	{
		Storage::disk('public')->makeDirectory('parts');
		$user = create(User::class);
		$part = create(Part::class, [
			'user_id' => $user->id,
		]);
		$response = $this->get(route('part', ['part' => $part]));

		$response->assertStatus(200);
	}
}
