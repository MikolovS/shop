<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\CartRequest;
use App\OrderInfo;
use App\Order;
use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
	public function add() {
		$product_id = (integer) \request('product_id');
		if (empty(Product::all()->where('id', $product_id)->toArray())) {
			$error_message = 'Такого товара не существует! Попробуйте перезагрузить страницу.';
			return back()->with(compact('error_message'));
		}
		$count = (integer) \request('count');
		if ($count === 0) {
			$count = 1;
		}
		if ($cart = Cart::cartExist()) {
			if (array_key_exists($product_id, $cart)) {
				$message = 'Товар уже в корзине.';
				return back()->with(compact('message'));
			}
		}
		$cart[$product_id] = $count;
		\Cookie::queue('cart', serialize($cart), 99999);
		$message = 'Товар добавлен в корзину.';
		return back()->with(compact('message'));
	}

	public function removeOne() {
		if ($cart = Cart::cartExist()) {
			$product_id = (integer) \request('product_id');
			if (array_key_exists($product_id, $cart)) {
				unset($cart[$product_id]);
				\Cookie::queue('cart', serialize($cart), 99999);
				$message = 'Товар удален из корзины.';
				if (empty($cart)) {
					return redirect('/')->with(compact('message'));
				}
				return back()->with(compact('message'));
			}
		}
		$error_message = 'Такого товара нет в корзине.';
		return back()->with(compact('error_message'));
	}

	public function show() {
		$products = [];
		$order_sum = 0;
		if ($cart = Cart::cartExist()) {
			$models = Product::all()->whereIn('id', array_keys($cart))->mapWithKeys(function ($item) {
				return [$item['id'] => $item];
			})->toArray();
			if (!empty($models)) {
				foreach ($models as $model) {
					$model['count'] = $cart[$model['id']];
					$model['price_total'] = $model['price'] * $model['count'];
					$products[] = $model;
					$order_sum += $model['price_total'];
				}
			}
		} else {
			$message = 'Ваша корзина пока пустая. Пожалуйста, для начала добавите товар в корзину.';
			return back()->with(compact('message'));
		}
		return view('public.user.cart', compact('products', 'order_sum'));
	}

	public function buy(CartRequest $request) {
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
		\Cookie::queue(\Cookie::forget('cart'));
		$message = 'Ваш заказ успешно принят. Спазибо за покупку!';
		return redirect('/')->with(compact('message'));
	}
}
