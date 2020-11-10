<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Type;
use App\Category;
use Illuminate\Http\Request;

class TypesController extends Controller
{
	public function getTypesByCategory(Request $request): Category
	{
		$request->validate(['category' => 'required|integer|exists:categories,id']);

		$category = Category::findOrFail($request->category);

		if ($category->isParent) {
			return $category->subTypes;
		}

		return $category->types;
	}

	public function show(Type $type): Type
	{
		// TODO: Return a view containing parts of passed type
		return $type;
	}
}
