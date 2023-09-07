<?php

use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShopController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

  
    Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'user-access:seller'])->group(function () {
  
    Route::get('/seller/home', [HomeController::class, 'sellerHome'])->name('seller.home');
});


Route::middleware(['auth', 'user-access:shipper'])->group(function () {
  
    Route::get('/shipper/home', [HomeController::class, 'shipperHome'])->name('shipper.home');
});


Route::get('/create-shop', 'App\Http\Controllers\ShopController@create')->name('create.shop');


Route::post('store-shop', 'App\Http\Controllers\ShopController@store')->name('store.shop');

Route::post('add',[ShopController::class,'add']);

Route::get('/introduce-shop',[ShopController::class,'introduce'])->name('introduce.shop');

Route::get('/buyer/home', [HomeController::class, 'index'])->name('buyer.home');
Route::get('/seller/home', [HomeController::class, 'sellerHome'])->name('seller.home');
Route::get('/shipper/home', [HomeController::class, 'shipperHome'])->name('shipper.home');

