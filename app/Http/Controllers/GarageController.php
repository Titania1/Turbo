<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Garage;
use Illuminate\View\View;
use Illuminate\Http\Request;

class GarageController extends Controller
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
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\View\View garage
	 */
	public function show(): View
	{
		$garage = auth()->user()->garage;
		if (! $garage) {
			$garage = Garage::create(['user_id' => auth()->id()]);
		}

		return view('garage', compact('garage'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Garage $garage)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Garage $garage)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Garage $garage)
	{
		//
	}
}
