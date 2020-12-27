<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\StorePartRequest;
use App\{Brand, Category, Part, Review};
use Illuminate\Http\{RedirectResponse, Request};

class PartsController extends Controller
{
	/**
	 * Display a listing of the parts.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(): View
	{
		$brands = Brand::select('id', 'name')->get();
		$categories = Category::select('name', 'id')->get();
		$parts = Part::where('user_id', auth()->id())->limit(4)->get();

		return view('shop', compact('brands', 'categories', 'parts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(StorePartRequest $request): RedirectResponse
	{
		$part = new Part();
		$part->vehicle_id = $request->vehicle;
		$part->title = $request->title;
		$part->description = $request->description;
		$part->key_features = json_encode(array_combine($request->keys, $request->features));
		if ($request->file('image')) {
			$path = $request->file('image')->store('parts', 'public');
			$part->image = $path;
		}
		$part->price = $request->price;
		$part->sku = $request->sku;
		// What is this doing????
		// Let's check the part class for a potential scope function
		// $part->inStock::where('part_id', $this->id)->where('quantity', '>', 0)->exists();
		$part->save();

		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Part $part): View
	{
		$reviews = Review::where('part_id', $part->id)->paginate(5);

		return view('part', compact('part', 'reviews'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Part $part)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Part $part)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Part $part)
	{
		//
	}
}
