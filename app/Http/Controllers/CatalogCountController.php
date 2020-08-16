<?php


/*
This entire controller is a hack for sake of performance
The catalog data are static in terms of count

This controller simply interject with the nova api calls that counts table records in the tecdoc database, and return the direct hardcoded count instead

Because the SQL operation to count is resource incentive and super slow, for example, it takes 9 seconds to count the articles
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogCountController extends Controller
{
	public function articles()
	{
		return response([
			'count' => 6722202
		], 200);
	}
}
