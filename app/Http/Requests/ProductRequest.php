<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

	    $product = $this->route('product');

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
				    'name' => 'required|min:2|unique:products,name',
				    'category_id' => 'required|integer',
				    'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
				    'price' => 'required|numeric',
			    ];
		    }
		    case 'PUT':
		    case 'PATCH':
		    {
			    return [
				    'name' => 'required|min:2|unique:products,name,' . $product->id,
				    'category_id' => 'required|integer',
				    'price' => 'required|numeric|max:999999999',
			    ];
		    }
		    default:break;
	    }
    }
}
