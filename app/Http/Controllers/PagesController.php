<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Part;
use App\Vehicle;
use App\Category;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;

class PagesController extends Controller
{
	/**
	 * Index page.
	 *
	 * Return the index view
	 * compacting data that includes
	 * Distinct vehicle years, brands, models and fuel types
	 *
	 * @return \Illuminate\View\View $view The index view
	 **/
	public function index(): View
	{
		$categories = Category::whereHas('categories', function (Builder $query) {
			$query->whereHas('types');
		})->limit(3)->with('subParts')->get();
		$years = Vehicle::select('from', 'to')->distinct()->pluck('from', 'to');
		// Get new arrivals
		$new_parts = Part::latest()->get();
		// Get their types
		return view('index', compact('years', 'new_parts', 'categories'));
	}
}
