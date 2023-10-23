<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\MapQuestController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
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
Route::prefix('buyer')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('buyer.home');
    Route::get('/shop/{shop_id}', [ShopController::class, 'view'])->name('shop.detail');
    // Các route khác cho người mua hàng
});

// Route cho người bán hàng (seller)
Route::prefix('seller')->group(function () {
    Route::get('/home', [HomeController::class, 'sellerHome'])->name('seller.home');
    Route::get('/create-shop', [ShopController::class, 'create'])->name('create.shop');
    Route::post('/store-shop', [ShopController::class, 'store'])->name('store.shop');
    Route::get('/introduce_shop/{id}', [ShopController::class, 'show'])->name('introduce.shop');
    Route::get('/edit/shop/{id}', [ShopController::class, 'list'])->name('edit.shop');
    Route::post('/update/shop/{id}', [ShopController::class, 'update'])->name('update.shop');
    Route::get('/shop/delete/{id}', [ShopController::class, 'delete'])->name('delete.shop');
    Route::get('/create/food/{shop_id}', [FoodController::class, 'create'])->name('create.food');
    Route::post('/store/food/', [FoodController::class, 'store'])->name('store.food');
    Route::get('/edit/food/{id}', [FoodController::class, 'list'])->name('edit.product');
    Route::get('/food/delete/{id}', [FoodController::class, 'delete'])->name('delete.food');
    // Các route khác cho người bán hàng
});

// Route cho người giao hàng (shipper)
Route::prefix('shipper')->middleware(['auth', 'user-access:shipper'])->group(function () {
    Route::get('/home', [HomeController::class, 'shipperHome'])->name('shipper.home');
    // Các route khác cho người giao hàng
});

// Route cho giỏ hàng và sản phẩm
Route::prefix('food')->group(function () {
    Route::get('/add-to-cart/{id}', [FoodController::class, 'addToCart'])->name('addToCart');
    Route::get('/cart', [FoodController::class, 'showCart'])->name('show.cart');
    Route::get('/update/quantity/{cart}', [FoodController::class, 'updateCart'])->name('update.cart');
    Route::get('/delete/{id}', [FoodController::class, 'deleteCart'])->name('delete.cart');
    // Các route khác cho giỏ hàng và sản phẩm
});

// Route danh sách sản phẩm theo loại
Route::get('/food', [FoodController::class, 'getFood'])->name('food.list');
Route::get('/drink', [FoodController::class, 'getDrink'])->name('drink.list');
Route::get('/flower', [FoodController::class, 'getFlower'])->name('flower.list');
Route::get('/market', [FoodController::class, 'getMarket'])->name('market.list');

// Route tìm kiếm sản phẩm
Route::get('/search', [FoodController::class,'search'])->name('food.search');

// Route đặt hàng và thanh toán
Route::get('/checkout', [OrderController::class,'index'])->name('checkout');
Route::post('/vnpay_payment', [OrderController::class,'vnpay_payment'])->name('vnpay.payment');
Route::post('/momo_payment',[OrderController::class,'momo_payment'])->name('momo.payment');
Route::post('/place-order', [OrderController::class,'store'])->name('place.order');
Route::get('/thank.order', function () {
    return view('buyer.thank_order');
});

//route profile
Route::get('/profile',[ProfileController::class,'show'])->name('show.profile');
Route::get('/order/detail/{order_id}',[ProfileController::class,'show_detail'])->name('order.detail');

//route 
// Route::get('/', [MapQuestController::class,'index']);


