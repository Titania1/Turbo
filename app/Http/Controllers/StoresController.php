<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoresController extends Controller
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
	 * @return \Illuminate\Http\Response
	 */
	public function show(Store $store): View
	{
		return view('store.index', compact('store'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Store $store)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Store $store)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Store $store)
	{
		//
	}
}
