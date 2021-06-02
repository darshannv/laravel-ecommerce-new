<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function subCategoryView(){

        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = Subcategory::latest()->get();
        return view('backend.category.subcategory_view',compact('subcategory', 'categories'));
    }

    public function subCategoryStore(Request $request){

        $validateData = $request->validate([

            'subcategory_name_en' => 'required',
            'subcategory_name_hin' => 'required',
            'category_id' => 'required',
     ],
    [
        'category_id.required' => 'Please Select Any option',
        'subcategory_name_en.required' => 'Input Category English Name',
        'subcategory_name_hin.required' => 'Input Category Hindi Name',

    ]);

        Subcategory::insert([
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_hin' => $request->subcategory_name_hin,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
            'subcategory_slug_hin' => str_replace(' ', '-',$request->subcategory_name_hin),
            'category_id' => $request->category_id,  
        ]);

        $notification = array(

            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function subCategoryEdit($id){

        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = Subcategory::with('category')->findOrFail($id);
        return view('backend.category.subcategory_edit',compact('subcategory', 'categories'));
    }

    public function subCategoryUpdate(Request $request){

        $cat_id = $request->id;

        $validateData = $request->validate([

            'subcategory_name_en' => 'required',
            'subcategory_name_hin' => 'required',
            'category_id' => 'required',
     ],
    [
        'category_id.required' => 'Please Select Any option',
        'subcategory_name_en.required' => 'Input SubCategory English Name',
        'subcategory_name_hin.required' => 'Input SubCategory Hindi Name',

    ]);

        Subcategory::findOrFail($cat_id)->update([
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_hin' => $request->subcategory_name_hin,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
            'subcategory_slug_hin' => str_replace(' ', '-',$request->subcategory_name_hin),
            'category_id' => $request->category_id,  
        ]);

        $notification = array(

            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function subCategoryDelete($id){

        Subcategory::findOrFail($id)->delete();
        $notification = array(

            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }


    //------------------ Sub->SubCategory ---------------
    public function subSubCategoryView(){

        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view',compact('subsubcategory', 'categories'));
    }


    //----------------- Ajax call --------------------

    public function getSubCategory($category_id){

        $subCat = Subcategory::where('category_id', $category_id)->orderBy('subcategory_name_en','ASC')->get();

        return json_encode($subCat);
    }

    public function subSubCategoryStore(Request $request){

        $validateData = $request->validate([

            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_hin' => 'required',
            'subcategory_id' => 'required',
            'category_id' => 'required',
     ],
    [
        'category_id.required' => 'Please Select Any option',
        'subsubcategory_name_en.required' => 'Input Sub-SubCategory English Name',
        'subsubcategory_name_hin.required' => 'Input Sub-SubCategory Hindi Name',

    ]);

        SubSubCategory::insert([
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hin' => str_replace(' ', '-',$request->subsubcategory_name_hin),
            'category_id' => $request->category_id,  
            'subcategory_id' => $request->subcategory_id,  
        ]);

        $notification = array(

            'message' => 'Sub-SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function subSubCategoryEdit($id){

        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = Subcategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);

        return view('backend.category.sub_subcategory_edit', compact('subcategories', 'categories', 'subsubcategories'));
    }

    public function subSubCategoryUpdate(Request $request){
        

        $validateData = $request->validate([

            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_hin' => 'required',
            'subcategory_id' => 'required',
            'category_id' => 'required',
     ],
    [
        'category_id.required' => 'Please Select Any option',
        'subsubcategory_name_en.required' => 'Input Sub-SubCategory English Name',
        'subsubcategory_name_hin.required' => 'Input Sub-SubCategory Hindi Name',

    ]);
        $subsub_id = $request->id;

        SubSubCategory::findOrFail($subsub_id)->update([
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hin' => str_replace(' ', '-',$request->subsubcategory_name_hin),
            'category_id' => $request->category_id,  
            'subcategory_id' => $request->subcategory_id,  
        ]);

        $notification = array(

            'message' => 'Sub-SubCategory Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.subsubcategory')->with($notification);

    }

    public function subSubCategoryDelete($id){

        SubSubCategory::findOrFail($id)->delete();
        $notification = array(

            'message' => 'Sub-SubCategory Updated Successfully',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
}
