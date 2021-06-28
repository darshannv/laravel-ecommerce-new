<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CashOrderController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('frontend.index');
// });







Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});


Route::middleware(['auth:admin'])->group(function(){


    //admin routes
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/store', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/profile/password', [AdminProfileController::class, 'adminProfilePassword'])->name('admin.profile.password');
    Route::post('/admin/password/update', [AdminProfileController::class, 'adminPasswordUpdate'])->name('admin.password.update');


    Route::prefix('brand')->group(function(){
        Route::get('/view', [BrandController::class, 'brandView'])->name('all.brand');
        Route::post('/store', [BrandController::class, 'brandStore'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'brandEdit'])->name('brand.edit');
        Route::post('/update', [BrandController::class, 'brandUpdate'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'brandDelete'])->name('brand.delete');
    
    });
    
    
    Route::prefix('category')->group(function(){
        //------------ All category---------------
        Route::get('/view', [CategoryController::class, 'categoryView'])->name('all.category');
        Route::post('/store', [CategoryController::class, 'categoryStore'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');
        Route::post('/update', [CategoryController::class, 'categoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');
    
        //-----------All Sub Category-----------------
        Route::get('/sub/view', [SubCategoryController::class, 'subCategoryView'])->name('all.subcategory');
        Route::post('/sub/store', [SubCategoryController::class, 'subCategoryStore'])->name('subcategory.store');
        Route::get('/sub/edit/{id}', [SubCategoryController::class, 'subCategoryEdit'])->name('subcategory.edit');
        Route::post('/sub/update', [SubCategoryController::class, 'subCategoryUpdate'])->name('subcategory.update');
        Route::get('/sub/delete/{id}', [SubCategoryController::class, 'subCategoryDelete'])->name('subcategory.delete');
    
        //----------All Sub-subcategory
        Route::get('/sub/sub/view', [SubCategoryController::class, 'subSubCategoryView'])->name('all.subsubcategory');
    
        Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'getSubCategory']);
        Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'getSubSubCategory']);
    
        Route::post('/sub/sub/store', [SubCategoryController::class, 'subSubCategoryStore'])->name('subsubcategory.store');
        Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'subSubCategoryEdit'])->name('subsubcategory.edit');
        Route::post('/sub/sub/update', [SubCategoryController::class, 'subSubCategoryUpdate'])->name('subsubcategory.update');
        Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'subSubCategoryDelete'])->name('subsubcategory.delete');
    });
    
    
    Route::prefix('product')->group(function(){
    
        //------------- Add Product -----------------------
        
        Route::get('/add', [ProductController::class, 'addProduct'])->name('add.product');
        Route::post('/store', [ProductController::class, 'storeProduct'])->name('product.store');
        Route::get('/manage', [ProductController::class, 'manageProduct'])->name('manage.product');
        Route::get('/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
        Route::get('/show/{id}', [ProductController::class, 'showProduct'])->name('product.show');
        Route::post('/update', [ProductController::class, 'updateProduct'])->name('product.update');
        Route::post('/image/update', [ProductController::class, 'multiImageUpdate'])->name('update.product.image');
        Route::post('/thumbnail/update', [ProductController::class, 'thumbnailUpdate'])->name('update.product.thumbnail');
        Route::get('/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');
        Route::get('/multiimg/delete/{id}', [ProductController::class, 'multiImgDelete'])->name('product.multiimg.delete');
    
        Route::get('/inactive/{id}', [ProductController::class, 'productInactive'])->name('product.inactive');
        Route::get('/active/{id}', [ProductController::class, 'productActive'])->name('product.active');
    
    
    
    });
    
            //------------- Manage Slider -------------------------
    Route::prefix('slider')->group(function(){
    
        Route::get('/view', [SliderController::class, 'sliderView'])->name('manage.slider');
        Route::post('/store', [SliderController::class, 'sliderStore'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'sliderEdit'])->name('slider.edit');
        Route::post('/update', [SliderController::class, 'sliderUpdate'])->name('slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'sliderDelete'])->name('slider.delete');
    
        Route::get('/inactive/{id}', [SliderController::class, 'sliderInactive'])->name('slider.inactive');
        Route::get('/active/{id}', [SliderController::class, 'sliderActive'])->name('slider.active');
    
    });



        //------------- Manage Coupons -------------------------
        Route::prefix('coupons')->group(function(){

            Route::get('/view', [CouponController::class, 'couponView'])->name('manage.coupons');
            Route::post('/store', [CouponController::class, 'couponStore'])->name('coupon.store');
            Route::get('/edit/{id}', [CouponController::class, 'couponEdit'])->name('coupon.edit');
            Route::post('/update', [CouponController::class, 'couponUpdate'])->name('coupon.update');
            Route::get('/delete/{id}', [CouponController::class, 'couponDelete'])->name('coupon.delete');
        
        });




         //------------- Manage Shipping Area -------------------------
         Route::prefix('shipping')->group(function(){
            //------ Division -----------
            Route::get('/division/view', [ShippingAreaController::class, 'divisionView'])->name('manage.division');
            Route::post('/division/store', [ShippingAreaController::class, 'divisionStore'])->name('division.store');
            Route::get('/division/edit/{id}', [ShippingAreaController::class, 'divisionEdit'])->name('division.edit');
            Route::post('/division/update', [ShippingAreaController::class, 'divisionUpdate'])->name('division.update');
            Route::get('/division/delete/{id}', [ShippingAreaController::class, 'divisionDelete'])->name('division.delete');

            //------ District -----------
            Route::get('/district/view', [ShippingAreaController::class, 'districtView'])->name('manage.district');
            Route::post('/district/store', [ShippingAreaController::class, 'districtStore'])->name('district.store');
            Route::get('/district/edit/{id}', [ShippingAreaController::class, 'districtEdit'])->name('district.edit');
            Route::post('/district/update', [ShippingAreaController::class, 'districtUpdate'])->name('district.update');
            Route::get('/district/delete/{id}', [ShippingAreaController::class, 'districtDelete'])->name('district.delete');

            //------ State -----------
            Route::get('/state/view', [ShippingAreaController::class, 'stateView'])->name('manage.state');
            Route::post('/state/store', [ShippingAreaController::class, 'stateStore'])->name('state.store');
            Route::get('/state/edit/{id}', [ShippingAreaController::class, 'stateEdit'])->name('state.edit');
            Route::post('/state/update', [ShippingAreaController::class, 'stateUpdate'])->name('state.update');
            Route::get('/state/delete/{id}', [ShippingAreaController::class, 'stateDelete'])->name('state.delete');

           
             //------- Ajax District Call --------------
         Route::get('/district/ajax/{division_id}', [ShippingAreaController::class, 'getDistrict']);
        
        });

        

});



//user routes
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profie', [IndexController::class, 'userProfile'])->name('user.profile');
Route::get('/user/password', [IndexController::class, 'userPassword'])->name('user.password');
Route::post('/user/profie/store', [IndexController::class, 'userProfileStore'])->name('user.profile.store');
Route::post('/user/password/update', [IndexController::class, 'userPasswordUpdate'])->name('user.password.update');


//------------------- Multi-Language routes --------------------------
Route::get('/language/english', [LanguageController::class, 'english'])->name('english.language');
Route::get('/language/hindi', [LanguageController::class, 'hindi'])->name('hindi.language');


//----------------- Frontend Product Details -----------------------
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'productDetails']);



//----------------- Frontend Product Tags ---------------------------
Route::get('/product/tag/{tag}', [IndexController::class, 'tagWiseProduct']);


//---------------- Subcategory wise data -------------------------------
Route::get('/subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'subcatWiseProduct']);

//---------------- Sub->Subcategory wise data -------------------------------
Route::get('/subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'subsubcatWiseProduct']);

//---------------- Product View Modal with Ajax -------------------------------
Route::get('/product/view/modal/{id}', [IndexController::class, 'productViewAjax']);

//---------------- Add to Cart with Ajax -------------------------------
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);

//----------------Get Data from Mini cart with Ajax -------------------------------
Route::get('/product/mini/cart', [CartController::class, 'addMiniCart']);


//----------------Remove Mini cart with Ajax -------------------------------
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'removeMiniCart']);

//---------------- Add to wishlist with Ajax -------------------------------
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'addToWishlist']);

Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function(){


        //--------------- Wishlist Page -------------------------------
    Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist');

    //--------------- Get Wishlist Product -------------------------------
    Route::get('/get-wishlist-product', [WishlistController::class, 'getWishlistProduct']);

    //---------------  Wishlist Remove -------------------------------
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'removeWishlistProduct']);

     //---------------  Stripe Order  -------------------------------
     Route::post('/stripe/order', [StripeController::class, 'stripeOrder'])->name('stripe.order');


     //---------------  Cash Order  -------------------------------
     Route::post('/cash/order', [CashOrderController::class, 'cashOrder'])->name('cash.order');

      //--------------- My Orders Page -------------------------------
    Route::get('/my-orders', [AllUserController::class, 'myOrders'])->name('my.orders');

     //--------------- View Orders  -------------------------------
     Route::get('/order-details/{order_id}', [AllUserController::class, 'orderDetails']);
   
});


 //Cart Routes  -----------
 Route::get('/myCart', [CartPageController::class, 'myCart'])->name('myCart');

 //--------------- get Cart Product -------------------------------
 Route::get('/user/get-cart-product', [CartPageController::class, 'getCartProduct']);

//--------------- remove Cart Product -------------------------------
Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'removeCartProduct']);

//---------------  Cart Increment -------------------------------
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'cartIncrement']);

//---------------  Cart Decrement -------------------------------
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'cartDecrement']);

//Frontend coupon option
Route::post('/coupon-apply', [CartController::class, 'couponApply']);
Route::get('/coupon-calculation', [CartController::class, 'couponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'couponRemove']);

//-------- checkout -----------------------
Route::get('/checkout', [CartController::class, 'checkoutCreate'])->name('checkout');


//ajax district call
Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'districtGetAjax']);
//ajax state call
Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'stateGetAjax']);
//checkout store
Route::post('/checkout/store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');