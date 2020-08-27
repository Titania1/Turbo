<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{

	public function accessSessionData(Request $request)
	{
		if ($request->session()->has('key'))

			echo $request->session()->get('key');
		else
			echo 'No data in the session';
	}

	public function storeSessionData(Request $request)
	{session(['key' => 'value']);
		
		$request->session()->put('key', 'value');
		// echo "Data has been added to session";
	
	}

	public function deleteSessionData(Request $request)
	{
		$request->session()->forget('key');
		// echo "Data has been removed from session.";

}