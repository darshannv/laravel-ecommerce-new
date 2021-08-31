<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function addProduct(){

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands'));
    }

    public function storeProduct(Request $request){


        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()). '.'. $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        $product_id =  Product::insertGetId([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_name_hin' => $request->product_name_hin,
            'product_slug_hin' => strtolower(str_replace(' ', '-', $request->product_name_hin)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_hin' => $request->product_tags_hin,
            'product_size_en' => $request->product_size_en,
            'product_size_hin' => $request->product_size_hin,
            'product_color_en' => $request->product_color_en,
            'product_color_hin' => $request->product_color_hin,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            
            'short_descp_en' => $request->short_descp_en,
            'short_descp_hin' => $request->short_descp_hin,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_hin' => $request->long_descp_hin,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offers' => $request->special_offers,
            'special_deals' => $request->special_deals,

            'product_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        //--------- Multi Image ------------
        
        $images = $request->file('multi_img');
        foreach($images as $img){
            $make_name = hexdec(uniqid()). '.'. $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;

            MultiImg::insert([

                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

      

        $notification = array(

            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.product')->with($notification);
    }



    public function manageProduct(){

        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }


    public function editProduct($id){

        $multiImgs = MultiImg::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategories = Subcategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();

        $product = Product::findOrFail($id);
        
        return view('backend.product.product_edit', compact('categories', 'brands', 'subcategories', 'subsubcategories', 'product', 'multiImgs'));
    }

    public function showProduct($id){

        $multiImgs = MultiImg::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategories = Subcategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();

        $product = Product::findOrFail($id);
        
        return view('backend.product.product_show', compact('categories', 'brands', 'subcategories', 'subsubcategories', 'product', 'multiImgs'));
    }


    public function updateProduct(Request $request){

        $product_id = $request->id;

        Product::findOrfail($product_id)->update([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_name_hin' => $request->product_name_hin,
            'product_slug_hin' => strtolower(str_replace(' ', '-', $request->product_name_hin)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_hin' => $request->product_tags_hin,
            'product_size_en' => $request->product_size_en,
            'product_size_hin' => $request->product_size_hin,
            'product_color_en' => $request->product_color_en,
            'product_color_hin' => $request->product_color_hin,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            
            'short_descp_en' => $request->short_descp_en,
            'short_descp_hin' => $request->short_descp_hin,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_hin' => $request->long_descp_hin,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offers' => $request->special_offers,
            'special_deals' => $request->special_deals,

           
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(

            'message' => 'Product Updated without Image Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.product')->with($notification);

    }



    public function multiImageUpdate(Request $request){

        $imgs = $request->multi_img;

        foreach($imgs as $id => $img){
            $imgDel = MultiImg::findOrfail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()). '.'. $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/'.$make_name);
            $savePath = 'upload/products/multi-image/'.$make_name;

            MultiImg::where('id', $id)->update([

                'photo_name' => $savePath,
                'updated_at' => Carbon::now(),
            ]);

        }

        $notification = array(

            'message' => 'Product Image Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function thumbnailUpdate(Request $request){

        $pro_id = $request->id;
        $oldImg = $request->old_image;
        if($oldImg){
            unlink($oldImg);
        }
       

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()). '.'. $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        Product::findOrFail($pro_id)->update([

            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

    

    $notification = array(

        'message' => 'Product Thumbnail Updated Successfully',
        'alert-type' => 'info'
    );

    return redirect()->back()->with($notification);

    }


    public function multiImgDelete($id){

        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);

        MultiImg::findOrfail($id)->delete();

        $notification = array(

            'message' => 'Product Image Deleted Successfully',
            'alert-type' => 'error'
        );
    
        return redirect()->back()->with($notification);

    }

    public function productInactive($id){

        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(

            'message' => 'Product is InActive',
            'alert-type' => 'warning'
        );
    
        return redirect()->back()->with($notification);

    }

    public function productActive($id){

        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(

            'message' => 'Product is Active',
            'alert-type' => 'warning'
        );
    
        return redirect()->back()->with($notification);
    }


    public function deleteProduct($id){

        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach($images as $img){
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'warning'
        );
    
        return redirect()->back()->with($notification);
    }

}
