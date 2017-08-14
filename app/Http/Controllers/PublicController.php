<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class PublicController extends Controller
{
    public function index() {
	    $categories =Category::all()->where('parent_id', 1)->toArray();
    	return view('public.category.index', compact('categories'));
    }

	public function show(Category $category){
		$collections = Category::all();
		$categories = $collections->where('parent_id', $category->id)->toArray();
		$branchIds = $category->categoryBranch($collections, $category->id);
		$links = $category->links($collections, $branchIds);
		if (empty($categories)) {
			$products = $category->products->toArray();
			return view('public.product.index', compact('products', 'category', 'links'));
		}
		return view('public.category.show', compact('categories', 'category', 'links'));
	}
}
