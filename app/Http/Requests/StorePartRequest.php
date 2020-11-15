<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'vehicle'     => 'nullable|integer|exists:vehicles,id',
			'type'        => 'nullable|integer|exists:types,id',
			'title'       => 'required|string|max:50',
			'description' => 'nullable|string|min:5|max:1000',
			'image'       => 'nullable|image|max:10000',
			'price'       => 'required|integer|min:10|max:1000000',
			'sku'         => 'nullable|string|min:6|max:20',
			'keys'        => 'nullable|array',
			'features'    => 'required_if:keys,value|array',
		];
	}
}
