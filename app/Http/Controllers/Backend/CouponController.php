<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function couponView(){

        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupons.view_coupon', compact('coupons'));
    }

    public function couponStore(Request $request){
        $validateData = $request->validate([

            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
     ]);

   
        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => now(),
        ]);

        $notification = array(

            'message' => 'Coupon Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function couponEdit($id){

        $coupons = Coupon::findOrFail($id);
        return view('backend.coupons.edit_coupon', compact('coupons'));
    }

    public function couponUpdate(Request $request){

        $coupon_id = $request->id;
        $validateData = $request->validate([

            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
     ]);

   
        Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'updated_at' => now(),
        ]);

        $notification = array(

            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.coupons')->with($notification);
    }

    public function couponDelete($id){

        Coupon::findOrFail($id)->delete();

        $notification = array(

            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
}
