<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class FallBackController extends Controller
{
	public function __invoke()
	{
		return response()->view('errors.404', [], 404);
	}
}
