<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Brand;
use App\Model;

class ModelsController extends Controller
{
	/**
	 * Display the specified resource.
	 *
	 * @param \App\Brand $brand The Brand model or ID
	 * @param string $brand_slug The brand slug (optional)
	 * @param \App\Model $model The vehicles grouping model
	 * @param string $slug The model slug
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Brand $brand, string $brand_slug = null, Model $model, string $slug = null)
	{
		if ($brand_slug != $brand->slug || $slug != $model->slug) {
			return redirect()->route('model', [$brand->id, $brand->slug, $model->id, $model->slug]);
		}
		return $model;
		$engines = $model->engines;

		return view('model', compact('engines', 'model'));
	}
}
