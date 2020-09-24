<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
	public function store(Request $request)
	{
		if (! Newsletter::isSubscribed($request->email)) {
			Newsletter::subscribePending($request->email);

			return redirect('/')->with('success', 'Thanks For Subscribe');
		}

		return redirect('/')->with('failure', 'Sorry! You have already subscribed ');
	}
}
