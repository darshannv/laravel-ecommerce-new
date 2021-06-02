<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\IndexController;

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



//admin routes
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');
Route::get('/admin/profile/password', [AdminProfileController::class, 'adminProfilePassword'])->name('admin.profile.password');
Route::post('/admin/password/update', [AdminProfileController::class, 'adminPasswordUpdate'])->name('admin.password.update');



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

    Route::post('/sub/sub/store', [SubCategoryController::class, 'subSubCategoryStore'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'subSubCategoryEdit'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update', [SubCategoryController::class, 'subSubCategoryUpdate'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'subSubCategoryDelete'])->name('subsubcategory.delete');
});


Route::prefix('product')->group(function(){

    //------------- Add Product -----------------------
    
    Route::get('/add', [ProductController::class, 'addProduct'])->name('add.product');

});