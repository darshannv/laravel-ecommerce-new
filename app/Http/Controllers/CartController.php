<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id){


        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);

        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id, 
                'name' => $request->product_name, 
                'qty' => $request->quantity, 
                'price' => $product->selling_price, 
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_thumbnail,
                    'size' => $request->size,
                    'color' => $request->color,
                    ]]);

                    return response()->json(['success' => 'Successfully Added to Cart']);
        }else{

            Cart::add([
                'id' => $id, 
                'name' => $request->product_name, 
                'qty' => $request->quantity, 
                'price' => $product->discount_price, 
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_thumbnail,
                    'size' => $request->size,
                    'color' => $request->color,
                    ]]);
                    return response()->json(['success' => 'Successfully Added to Cart']);

        }
    }



    //mini cart section
    public function addMiniCart(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));
    }


    //remove mini cart
    public function removeMiniCart($rowId){
        Cart::remove($rowId);

        return response()->json(['success' => 'Product removed from the Cart']);
    }


    //add to wishlist
    public function addToWishlist(Request $request,$product_id){

        if(Auth::check()){

            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if(!$exists){
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Successfully added to Wishlist']);
            }else{
                return response()->json(['error' => 'This Product is already in your Wishlist']);
            }

            
        }else{
            return response()->json(['error' => 'First Login to your Account']);
        }
    }




    //---------- Coupon Apply
    public function couponApply(Request $request){

        $coupon = Coupon::where('coupon_name', $request->coupon_name)
                            ->where('coupon_validity','>=', Carbon::now()->format('Y-m-d'))->first();
        if($coupon){
           
            Session::put('coupon', [

                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),
            ]);

            return response()->json([
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ]);

        } else {
            return response()->json(['error' => 'Invalid coupon']);
        }

    }

    public function couponCalculation(){

        if(Session::has('coupon')){
            return response()->json(array(

                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total()
            ));
        }
    }

    public function couponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed Successfully']);

    }

    //Checkout
    public function checkoutCreate(){
        if(Auth::check()){

            if(Cart::total() > 0){


                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'divisions'));
            } else{

                $notification = array(

                    'message' => 'Cart must have one product to Checkout',
                    'alert-type' => 'error'
                );
        
                return redirect()->to('/')->with($notification);
            }
        } else{
            $notification = array(

                'message' => 'You must login to Proceed',
                'alert-type' => 'error'
            );
    
            return redirect()->route('login')->with($notification);
        }
    }
}
