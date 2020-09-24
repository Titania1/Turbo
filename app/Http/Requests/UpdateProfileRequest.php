<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
	/**
	 * The key to be used for the view error bag.
	 *
	 * @var string
	 */
	protected $errorBag = 'profile';

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return auth()->check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 */
	public function rules(): array
	{
		return [
			'name' => ['bail', 'required', 'string', 'max:255'],
			'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
			'phone' => $this->phone_rules(),
		];
	}

	/**
	 * Get the validation rules that apply to the phone number.
	 */
	private function phone_rules(): array
	{
		return [ // Escape the pipe used by laravel for the regex
			'bail',
			'required',
			'digits:10',
			'regex:/^(0)(5|6|7)(4|5|6|7)[0-9]{7}$/',
		];
	}
}
