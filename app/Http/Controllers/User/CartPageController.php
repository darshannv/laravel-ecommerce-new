<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPageController extends Controller
{
    public function myCart(){
        return view('frontend.wishlist.view_mycart');
    }

    public function getCartProduct(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));
    }

    public  function removeCartProduct($rowId){

        Cart::remove($rowId);
        return response()->json(['success' => 'Product Removed from Cart Successfully']);

    }

    //cart Increment
    public function cartIncrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        return response()->json(['Increment']);

    }
     //cart Decrement
     public function cartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json(['Decrement']);

    }
}
