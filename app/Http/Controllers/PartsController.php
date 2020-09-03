<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Part;
use App\Review;
use App\Vehicle;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StorePartRequest;

class PartsController extends Controller
{
	/**
	 * Display a listing of the parts.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$vehicles = Vehicle::select('model', 'id')->get();
		$categories = Category::select('name', 'id')->get();
		$parts = Part::where('user_id', auth()->id())->limit(4)->get();

		return view('shop', compact('vehicles', 'categories', 'parts'));
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
	public function store(StorePartRequest $request)
	{
		$part = new Part();
		$part->vehicle_id = $request->vehicle;
		$part->type_id = $request->type;
		$part->title = $request->title;
		$part->description = $request->description;
		$part->key_features = json_encode(array_combine($request->keys, $request->features));
		if ($request->file('image')) {
			$path = $request->file('image')->store('parts', 'public');
			$part->image = $path;
		}
		$part->price = $request->price;
		$part->sku = $request->sku;
		$part->inStock::where('part_id', $this->id)->where('quantity', '>', 0)->exists();
		$part->save();
		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Part $part)
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
