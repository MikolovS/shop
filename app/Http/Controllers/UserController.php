<?php

namespace App\Http\Controllers;


class UserController extends Controller
{
	public function addToCart() {
		$product_id = (integer) \request('product_id');
		$count = (integer) \request('count');
		$cart = [];
		if (isset($_COOKIE['cart'])) {
			$cart = unserialize($_COOKIE['cart']);
		}
		if (!array_key_exists ($product_id, $cart)) {
			$cart[$product_id] = $count;
			setcookie('cart', serialize($cart), 0, '/');
			$message = 'Товар добавлен в корзину.';
			return redirect()->back()->with(compact('message'));
		}
		$message = 'Товар уже в корзине.';
		return redirect()->back()->with(compact('message'));
	}
}