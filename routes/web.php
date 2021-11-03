<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\HomeController;
use App\Http\Controllers\AdminControllers\CategoryController;
use App\Http\Controllers\AdminControllers\ProductController;
use App\Http\Controllers\AdminControllers\OrderController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\FrontendControllers\FrontendController;
use App\Http\Controllers\FrontendControllers\CartController;
use App\Http\Controllers\FrontendControllers\CheckoutController;
use App\Http\Controllers\FrontendControllers\UserController;
use App\Http\Controllers\FrontendControllers\WishlistController;
use App\Http\Controllers\FrontendControllers\RatingControlller;
use App\Http\Controllers\FrontendControllers\ReviewController;
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
//     return view('welcome');
// });

Route::get('/',[FrontendController::class,'index']);
Route::get('/category',[FrontendController::class,'category']);
Route::get('/view-category/{slug}',[FrontendController::class,'viewcategory']);
Route::get('/category/{cate_slug}/{pro_slug}',[FrontendController::class,'viewproduct']);
Route::post('/add-to-cart',[CartController::class,'addproduct']);
Route::post('/delete-to-cart',[CartController::class,'deleteproduct']);
Route::post('/update-cart',[CartController::class,'updatecart']);
Route::post('/add-to-wishlist',[WishlistController::class,'addwishlist']);
Route::post('/delete-to-wishlist',[WishlistController::class,'deleteitem']);
Route::get('/load-cart-data',[CartController::class,'cartcount']);
Route::get('/load-wishlist-data',[WishlistController::class,'wishlistcount']);
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function(){
    Route::get('/cart',[CartController::class,'viewcart']);
    Route::get('/checkout',[CheckoutController::class,'index']);
    Route::post('/place-order',[CheckoutController::class,'placeorder']);
    Route::get('/my-orders',[UserController::class,'index']);
    Route::get('/view-order/{id}/{notify_id?}',[UserController::class,'view']);
    Route::get('/wishlist',[WishlistController::class,'index']);
    Route::get('/add-review/{slug}/userreview',[ReviewController::class,'add']);
    Route::get('/edit-review/{slug}/userreview',[ReviewController::class,'edit']);
    Route::post('/add-review',[ReviewController::class,'create']);
    Route::put('/edit-review',[ReviewController::class,'update']);
    Route::post('/proceed-to-pay',[CheckoutController::class,'razorpaycheck']);
    Route::post('/add-rating',[RatingControlller::class,'addrating']);
    Route::get('/profile',[UserController::class,'profile']);
    Route::put('/update-profile/{id}',[UserController::class,'updateprofile']);
    Route::put('/update-address/{id}',[UserController::class,'updateaddress']);
    Route::get('/download/{file_name}',[UserController::class,'download']);
});

Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[HomeController::class,'index']);
    Route::get('/categories',[CategoryController::class,'index']);
    Route::get('/add-categories',[CategoryController::class,'add']);
    Route::post('/add-categories',[CategoryController::class,'insert']);
    Route::get('/edit-category/{id}',[CategoryController::class,'edit']);
    Route::put('/edit-category/{id}',[CategoryController::class,'update']);
    Route::get('/delete-category/{id}',[CategoryController::class,'delete']);
    Route::get('/products',[ProductController::class,'index']);
    Route::get('/add-products',[ProductController::class,'add']);
    Route::post('/add-products',[ProductController::class,'insert']);
    Route::get('/edit-product/{id}',[ProductController::class,'edit']);
    Route::put('/edit-product/{id}',[ProductController::class,'update']);
    Route::get('/delete-product/{id}',[ProductController::class,'delete']);
    Route::get('/orders',[OrderController::class,'index']);
    Route::get('/admin/view-order/{id}/{notify_id?}',[OrderController::class,'view']);
    Route::put('/update-order/{id}',[OrderController::class,'updateorder']);
    Route::get('/order-history',[OrderController::class,'orderhistory']);
    Route::get('/users',[DashboardController::class,'users']);
    Route::get('/view-user/{id}/',[DashboardController::class,'viewuser']);
    Route::get('/mark-all-read',[HomeController::class,'markallread']);
});