<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Category;

class PublicController extends Controller
{
    public function index() {
	    $categories =Category::all()->where('parent_id', 1)->toArray();
    	return view('public.category.index', compact('categories'));
    }

	public function showCategory(Category $category){
		$collections = Category::all();
		$categories = $collections->where('parent_id', $category->id)->toArray();
		$branchIds = $category->categoryBranch($collections, $category->id);
		$links = $category->links($collections, $branchIds);
		if (empty($categories)) {
			$products = $products_models = $category->products->toArray();
			if ($cart = Cart::cartExist()) {
				$products = [];
				foreach ($products_models as $products_model) {
					if(array_key_exists ($products_model['id'], $cart)) {
						$products_model['in_cart'] = TRUE;
					}
					$products[] = $products_model;
				}
			}
			return view('public.product.index', compact('products', 'category', 'links'));
		}
		return view('public.category.show', compact('categories', 'category', 'links'));
	}

	public function showProduct(Product $product) {
		$category = $product->category;
		$collections = Category::all();
		$branchIds = $category->categoryBranch($collections, $category->id);
		$links = $category->links($collections, $branchIds);
		return view('public.product.show', compact( 'product', 'links'));
	}
}
