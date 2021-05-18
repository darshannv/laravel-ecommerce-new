<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function adminProfile(){
        $adminData = Admin::find(1);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function adminProfileEdit(){
        $editData = Admin::find(1);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function adminProfileStore(Request $request){
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            if(!empty($data->profile_photo_path)){
                @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            }
            $fileName = date('YmdHi'). $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $fileName);
                $data['profile_photo_path'] = $fileName;
           
        }

        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);

    }

    public function adminProfilePassword(){

        return view('admin.admin_change_password');
    }

    public function adminPasswordUpdate(Request $request){

        
        $validateData = $request->validate([

            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
       
        $hashedPassword = Admin::find(1)->password;

        if(Hash::check($request->old_password, $hashedPassword)){
            
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
           
            $admin->save();
            Auth::logout();

            $notification = array(
                'message' => 'Profile Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.logout');

            
        } else {

            $notification = array(
                'message' => 'Password Change Failed',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        
    }
}
