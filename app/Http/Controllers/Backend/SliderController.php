<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    //

    public function sliderView(){
        $sliders = Slider::latest()->get();

        return view('backend.slider.slider_view', compact('sliders'));
    }


    public function sliderStore(Request $request){
        
        $validateData = $request->validate([
               'slider_img' => 'required',
        ],
       [
           'slider_img.required' => 'Please Select One Image',
          
   
       ]);
   
           $image = $request->file('slider_img');
           $name_gen = hexdec(uniqid()). '.'. $image->getClientOriginalExtension();
           Image::make($image)->resize(870, 370)->save('upload/slider/'.$name_gen);
           $save_url = 'upload/slider/'.$name_gen;
   
           Slider::insert([
   
               'title' => $request->title,
               'description' => $request->description,
               'slider_img' => $save_url,
              
           ]);
   
           $notification = array(
   
               'message' => 'Slider Inserted Successfully',
               'alert-type' => 'success'
           );
   
           return redirect()->back()->with($notification);
       }


       public function sliderEdit($id){
           $slider = Slider::findOrFail($id);
           return view('backend.slider.slider_edit', compact('slider'));
       }



       public function sliderUpdate(Request $request){
        $slider_id = $request->id;
        $old_image = $request->old_image;

        if($request->file('slider_img')){

           @unlink($old_image);
           $image = $request->file('slider_img');
           $name_gen = hexdec(uniqid()). '.'. $image->getClientOriginalExtension();
           Image::make($image)->resize(870, 370)->save('upload/slider/'.$name_gen);
           $save_url = 'upload/slider/'.$name_gen;
   
           Slider::findOrFail($slider_id)->update([
   
            'title' => $request->title,
            'description' => $request->description,
            'slider_img' => $save_url,
              
           ]);
   
           $notification = array(
   
               'message' => 'Slider Updated Successfully',
               'alert-type' => 'info'
           );
   
           return redirect()->route('manage.slider')->with($notification);
        } else {
           Slider::findOrFail($slider_id)->update([
            'title' => $request->title,
            'description' => $request->description,
              
           ]);
   
           $notification = array(
   
               'message' => 'Slider Updated Successfully',
               'alert-type' => 'info'
           );
   
           return redirect()->route('manage.slider')->with($notification);
        } 

    }


    public function sliderDelete($id){

        $slider = Slider::findOrFail($id);
        $img = $slider->slider_img;
        unlink($img);
        $slider->delete();

        $notification = array(
   
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }


    public function sliderInactive($id){

        Slider::findOrFail($id)->update(['status' => 0]);
        $notification = array(

            'message' => 'Slider is InActive',
            'alert-type' => 'warning'
        );
    
        return redirect()->back()->with($notification);

    }


    public function sliderActive($id){

        Slider::findOrFail($id)->update(['status' => 1]);
        $notification = array(

            'message' => 'Slider is Active',
            'alert-type' => 'warning'
        );
    
        return redirect()->back()->with($notification);

    }
}
