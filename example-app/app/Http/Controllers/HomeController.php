<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Auth;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sellerHome()
    {

    $userId = Auth::id(); // Lấy id của người dùng đang đăng nhập
    $shop = Shop::where('owner_id', $userId)->get();

    return view('sellerHome', ['shop' => $shop]);
    }

    public function shipperHome()
    {
        return view('shipperHome');
    }
}
