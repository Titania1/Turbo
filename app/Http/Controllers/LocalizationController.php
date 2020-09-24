<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
	public function switch(string $lang)
	{
		if (in_array($lang, config('app.locales'))) {
			session(['locale' => $lang]);
		}

		return back();
	}
}
