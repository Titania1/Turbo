<?php

namespace App\Http\Controllers;

use App\Store;
use App\StoreAbout;
use Illuminate\Http\Request;

class StoreAboutController extends Controller
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
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Store  $store
	 * @return \Illuminate\Http\Response
	 */
	public function show(Store $store)
	{
		$contact = $store->contact;

		return view('store.about', compact('about', 'store'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\StoreAbout  $storeAbout
	 * @return \Illuminate\Http\Response
	 */
	public function edit(StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\StoreAbout  $storeAbout
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, StoreAbout $storeAbout)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\StoreAbout  $storeAbout
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(StoreAbout $storeAbout)
	{
		//
	}
}
