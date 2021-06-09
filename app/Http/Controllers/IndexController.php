<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){
        $products = Product::where('status',  1)->orderBy('id', 'DESC')->get();
        $sliders = Slider::where('status',  1)->orderBy('id', 'DESC')->limit(3)->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.index', compact('categories', 'sliders', 'products'));
    }

    public function userLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));

    }

    public function userProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
      
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            if(!empty($data->profile_photo_path)){
                @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            }
            $fileName = date('YmdHi'). $file->getClientOriginalName();
                $file->move(public_path('upload/user_images'), $fileName);
                $data['profile_photo_path'] = $fileName;
           
        }

        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }

    public function userPassword(){
        return view('frontend.profile.change_password');
    }

    public function userPasswordUpdate(Request $request){

        $validateData = $request->validate([

            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
       
        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->old_password, $hashedPassword)){
            
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
           
            $user->save();
            Auth::logout();

            $notification = array(
                'message' => 'Password Changed Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('user.logout')->with($notification);

            
        } else {

            $notification = array(
                'message' => 'Password Change Failed',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
