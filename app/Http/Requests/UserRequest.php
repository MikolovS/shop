<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return TRUE;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$user = $this->route('user');

		switch($this->method())
		{
			case 'GET':
			case 'DELETE':
			{
				return [];
			}
			case 'POST':
			{
				return [
					'user' => 'required|array',
					'user.nick_name' => [
						'required'
					],
					'user.name' => [
						'required',
						'regex:/[a-zA-Zа-яА-ЯёЁ\s-]+$/'
					],
					'user.phone' => [
						'required',
						'regex:/\+38\s\(0[0-9]{2}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}/'
					],
					'user.address' => 'required',
					'user.email' => 'required|email',
					'user.payment_type' => 'required|integer',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [];
			}
			default:break;
		}
	}
}
