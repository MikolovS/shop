<?php

namespace App\Http\Controllers;


use App\Order;
use App\Product;

class UserController extends Controller
{
	public function profile () {
		$user = \Auth::user()->toArray();
		return view('public.user.profile', compact('user'));
	}
}