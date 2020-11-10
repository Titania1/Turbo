<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
	public function getPartsByCategory(Request $request) : Category
	{
		$category = Category::find($request->category);
		$products = $category->products()->select('id', 'name')->get();

		return $products;
	}
}
