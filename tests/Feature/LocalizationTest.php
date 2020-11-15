<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class LocalizationTest extends TestCase
{
	/**
	 * Test users can change locale.
	 *
	 * @return void
	 */
	public function test_locale_is_inserted_in_session()
	{
		$response = $this->get('/');
		$response->assertSessionMissing('locale');
		$response = $this->get('/lang/fr');
		$response->assertSessionHas('locale', 'fr');
		$response->assertRedirect('/');
		$response = $this->get('/');
		$response->assertSee('À Propos');
		$this->assertEquals('fr', app()->getLocale());
	}
}
