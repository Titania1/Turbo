<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\{Part, Review};
use App\Http\Requests\ReviewPartRequest;
use Illuminate\Http\{RedirectResponse, Request};
class ReviewsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
	public function store(ReviewPartRequest $request, Part $part): RedirectResponse
	{
		$review = new Review();
		$review->rating = $request->rating;
		$review->content = $request->content;
		$review->part_id = $part->id;
		$review->name = $request->name;
		$review->email = $request->email;
		$review->save();

		return redirect(route('part', $part).'#product-tab-reviews')->with(['active_tab' => 'reviews']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Review $review)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Review $review)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Review $review)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Review $review)
	{
		//
	}
}
