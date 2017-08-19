<?php

namespace App;


class Cart
{
    public static function cartExist() {
	    if ($cookie = request()->cookie('cart')) {
		    return  unserialize($cookie);
	    }
	    return FALSE;
    }

    public static function cartCount() {
    	if ($cart = Cart::cartExist()) {
		    return count($cart);
	    }
	    return 0;
    }
}
