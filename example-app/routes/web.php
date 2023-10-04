<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShopController;

// Route chào mừng
Route::get('/', function () {
    return view('welcome');
});

// Route xác thực người dùng
Auth::routes();

// Route trang chủ
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route cho người mua hàng (buyer)
    Route::get('/buyer/home', [HomeController::class, 'index'])->name('buyer.home');
    Route::get('/shop/{shop_id}', [ShopController::class, 'view'])->name('shop.detail');
    

// Route cho người bán hàng (seller)
Route::middleware(['auth', 'user-access:seller'])->group(function () {
    Route::get('/seller/home', [HomeController::class, 'sellerHome'])->name('seller.home');
    Route::get('/create-shop', 'App\Http\Controllers\ShopController@create')->name('create.shop');
    Route::post('/store-shop', 'App\Http\Controllers\ShopController@store')->name('store.shop');
    Route::get('/introduce_shop/{id}', [ShopController::class, 'show'])->name('introduce.shop');
    Route::get('/edit/shop/{id}', [ShopController::class, 'list'])->name('edit.shop');
    Route::post('/update/shop/{id}', [ShopController::class, 'update'])->name('update.shop');
    Route::get('/create/food/{shop_id}', [FoodController::class, 'create'])->name('create.food');
    Route::post('/store/food/', [FoodController::class, 'store'])->name('store.food');
    Route::get('/edit/food/{id}', [FoodController::class, 'list'])->name('edit.product');
    Route::get('/food/delete/{id}', [FoodController::class, 'delete'])->name('delete.food');
});

// Route cho người giao hàng (shipper)
Route::middleware(['auth', 'user-access:shipper'])->group(function () {
    Route::get('/shipper/home', [HomeController::class, 'shipperHome'])->name('shipper.home');
});

// Route cho giỏ hàng và sản phẩm
Route::get('food/add-to-cart/{id}', [FoodController::class, 'addToCart'])->name('addToCart');
Route::get('food/cart', [FoodController::class, 'showCart'])->name('show.cart');
Route::get('update/quantity/{cart}', [FoodController::class, 'updateCart'])->name('update.cart');
Route::get('food/delete/{id}', [FoodController::class, 'deleteCart'])->name('delete.cart');

// Route danh sách sản phẩm theo loại
Route::get('/food', [FoodController::class, 'getFood'])->name('food.list');
Route::get('/drink', [FoodController::class, 'getDrink'])->name('drink.list');
Route::get('/flower', [FoodController::class, 'getFlower'])->name('flower.list');
Route::get('/market', [FoodController::class, 'getMarket'])->name('market.list');

Route::get('/search', [FoodController::class,'search'])->name('food.search');

