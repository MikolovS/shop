<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
	    $category = $this->route('category');

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
				    'name' => 'required|min:2|unique:categories,name',
				    'parent_id' => 'required|integer',
				    'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
			    ];
		    }
		    case 'PUT':
		    case 'PATCH':
		    {
			    return [
				    'name' => 'required|min:2|unique:categories,name,' . $category->id,
				    'parent_id' => 'required|integer',
				    'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
			    ];
		    }
		    default:break;
	    }
    }
}
