<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
	    $cart = $this->route('cart');

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
			    	'order_items' => 'required|array',
				    'order_items.*.product_id' => 'required|integer',
				    'order_items.*.count' => 'required|integer',

				    'user' => 'required|array',
				    'user.name' => [
				    	'required',
					    'regex:/[a-zA-Zа-яА-ЯёЁ\s-]+$/'
				    ],
				    'user.phone' => [
				    	'required',
				    	'regex:/\+38\s\(0[0-9]{2}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}/'
				    ],
				    'user.address' => 'required',
				    'user.email' => 'nullable|email',
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
