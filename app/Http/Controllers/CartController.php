<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\OrderInfo;
use App\Order;
use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
	public function addToCart()
	{
		$product_id = (integer)\request('product_id');
		$count = (integer)\request('count');
		$cart = [];
		if (isset($_COOKIE['cart'])) {
			$cart = unserialize($_COOKIE['cart']);
		}
		if (!array_key_exists($product_id, $cart)) {
			$cart[$product_id] = $count;
			setcookie('cart', serialize($cart), 99999, '/');
			$message = 'Товар добавлен в корзину.';
			return redirect()->back()->with(compact('message'));
		}
		$message = 'Товар уже в корзине.';
		return redirect()->back()->with(compact('message'));
	}

	public function show()
	{
		$products = [];
		if (isset($_COOKIE['cart'])) {
			$cart = unserialize($_COOKIE['cart']);
			$models = Product::all()->whereIn('id', array_keys($cart))->mapWithKeys(function ($item) {
				return [$item['id'] => $item];
			})->toArray();
			if (!empty($models)) {
				foreach ($models as $model) {
					$model['count'] = $cart[$model['id']];
					$model['price_total'] = $model['price'] * $model['count'];
					$products[] = $model;
				}
			}
		}
		return view('public.user.cart', compact('products'));
	}

	public function buy(CartRequest $request)
	{
		\DB::transaction(function() {
			$order = new Order();
			if (\Auth::user()) {
				$order->user_id = \Auth::user()->id;
			}
			$order->save();

			$temp_order_items = request('order_items');
			$products = Product::all()->whereIn('id', array_keys($temp_order_items))->mapWithKeys(function ($item) {
				return [$item['id'] => $item['price']];
			})->toArray();
			$order_items = [];
			$total_price = 0;
			foreach ($temp_order_items as $id => $temp_order_item) {
				$temp_order_item['order_id'] = $order->id;
				$temp_order_item['price'] = $products[$id];
				$order_items[] = $temp_order_item;
				$total_price += $temp_order_item['price'] * $temp_order_item['count'];
			}
			$order->total_price = $total_price;
			$order->save();
			OrderItem::insert($order_items);

			$inf_client = \request('user');
			$inf_client['order_id'] = $order->id;
			OrderInfo::insert($inf_client);
		});

	}
}
