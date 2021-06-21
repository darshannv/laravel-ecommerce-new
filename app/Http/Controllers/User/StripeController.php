<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{
    public function stripeOrder(Request $request){

        if(Session::has('coupon')){
            
            $total_amount = Session::get('coupon')['total_amount'];
        } else{
            $total_amount = round(Cart::total());
        }

        \Stripe\Stripe::setApiKey('sk_test_51J3LVkSG7a4a5B2TnDR5XHnnOvTLuFm8S0RHLPyDaTeLSJlUcZUlN1aFvEK2LmZSfsckshlm5IMaaSpWLrayrCEL00soQjLxYU');

            $token = $_POST['stripeToken'];

            $charge = \Stripe\Charge::create([
            'amount' => $total_amount*100,
            'currency' => 'INR',
            'description' => 'Zersys Ecommerce',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
            ]);

            // dd($charge);

            $order_id = Order::insertGetId([

                'user_id' => Auth::id(),
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_id' => $request->state_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'notes' => $request->notes,

                'payment_type' => $charge->payment_method,
                'payment_method' => 'Stripe',
                'transaction_id' => $charge->balance_transaction,
                'currency' => $charge->currency,
                'amount' => $total_amount,
                'order_number' => $charge->metadata->order_id,
                'invoice_no' => 'EZ'. mt_rand(10000000,99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'Pending',
                'Created_at' => Carbon::now(),
               
                
            ]);

            //Email data
            $invoice = Order::findOrFail($order_id);
            $data = [
                'invoice_no' => $invoice->invoice_no,
                'amount' => $total_amount,
                'name' => $invoice->name,
                'email' => $invoice->email,
            ];

            Mail::to($request->email)->send(new OrderMail($data));


            $carts = Cart::content();
            foreach($carts as $cart){
                OrderItem::insert([
                    'order_id' => $order_id,
                    'product_id' => $cart->id,
                    'color' => $cart->options->color,
                    'size' => $cart->options->size,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'created_at' => Carbon::now(),
                   
                ]);
            }

            if(Session::has('coupon')){
                Session::forget('coupon');
            }

            Cart::destroy();

            $notification = array(
                'message' => 'Order Placed Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard')->with($notification);

    }
}
