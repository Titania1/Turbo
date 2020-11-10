<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class FallBackController extends Controller
{
	public function __invoke(): Response
	{
		return response()->view('errors.404', [], 404);
	}
}
