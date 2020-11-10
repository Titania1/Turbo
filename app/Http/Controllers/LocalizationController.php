<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LocalizationController extends Controller
{
	/**
	 * Change site language.
	 *
	 * Switches the app locale to the passed locale
	 *
	 * @param string $lang The language code
	 * @return void
	 **/
	public function switch(string $lang): RedirectResponse
	{
		if (in_array($lang, config('app.locales'))) {
			session(['locale' => $lang]);
		}

		return back();
	}
}
