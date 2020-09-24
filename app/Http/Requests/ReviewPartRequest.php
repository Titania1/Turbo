<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewPartRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'content' => 'bail|nullable|string|max:64000',
			// If user is logged in then email and name are not required
			'name' => 'bail|' . auth()->check() ? 'nullable|' : 'required|' . 'string|min:3|max:30',
			'email' => 'bail|' . auth()->check() ? 'nullable|' : 'required|' . 'email',
			'rating' => 'bail|required|integer|between:1,5',
		];
	}
}
