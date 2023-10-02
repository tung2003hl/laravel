<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
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
        if (auth()->check()) {
            // Nếu đã đăng nhập, lấy danh sách sản phẩm
            $food = Food::join('categories', 'food.category_id', '=', 'categories.id') // Sử dụng phương thức join()
                    ->select('food.*', 'categories.category_name') // Lấy tất cả trường từ bảng foods và cột category_name từ bảng categories
                    ->get(); // Hoặc bạn có thể thay thế bằng truy vấn tùy chỉnh

            $shopName = Shop::pluck('name','id');
            return view('buyer.home', compact('food', 'shopName'));
        } else {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            return redirect()->route('login');
        }
    }

    public function sellerHome()
    {
    $userId = Auth::id(); // Lấy id của người dùng đang đăng nhập
    $shop = Shop::where('owner_id', $userId)->get();
    return view('seller.sellerHome', ['shop' => $shop]);
    }

    public function shipperHome()
    {
        return view('shipper.shipperHome');
    }
}
