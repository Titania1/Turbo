<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Part;
use Illuminate\View\View;
use App\Http\Requests\SearchRequest;

class SearchController extends Controller
{
	/**
	 * Perform a scout search.
	 *
	 * Search for parts with the given specs
	 *
	 * @param SearchRequest $request The search request
	 *
	 **/
	public function search(SearchRequest $request): View
	{
		// Get values request array
		$criteria = array_values($request->validated());
		// Build a search string
		$criteria = implode(' ', $criteria);
		// Search for parts matching criteria
		$parts = Part::search($criteria)
			->paginate(10);

		return view('search.results', compact('parts'));
	}
}
