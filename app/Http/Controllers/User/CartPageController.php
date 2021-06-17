<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
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
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        return response()->json(['success' => 'Product Removed from Cart Successfully']);

    }

    //cart Increment
    public function cartIncrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if(Session::has('coupon')){

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [

                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),
            ]);
        }


        return response()->json(['Increment']);

    }
     //cart Decrement
     public function cartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);


        if(Session::has('coupon')){

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [

                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),
            ]);
        }
        return response()->json(['Decrement']);
    }
}
