<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Food;
use App\Models\Shop;
use App\Models\Wishlist;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

            $wishlistItems = $this->getWishlistItems(auth()->id());

            $shopName = Shop::pluck('name','id');

            $wishlistcount = $this->WishListShowCount(auth()->id());

            View::share('wishlistItems', $wishlistItems);
            View::share('food', $food);
            View::share('shopName', $shopName);
            View::share('wishlistcount', $wishlistcount);

            return view('buyer.home', compact('wishlistItems','food', 'shopName','wishlistcount'));
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
    public function WishListShowCount($id)
{
    $wishlistcount = Wishlist::where('user_id', $id)->count();

    return $wishlistcount;
}

    protected function getWishlistItems($userId)
    {
        // Lấy dữ liệu từ bảng wishlist và food với điều kiện liên kết food_id và id
        return DB::table('wishlists')
                    ->join('food', 'wishlists.food_id', '=', 'food.id')
                    ->select('wishlists.id as wishlist_id','food.name', 'food.price','food.image_url')
                    ->where('wishlists.user_id', $userId)
                    ->get();
    }

    public function removeItem(Request $request, $wishlist_id)
    {
        // Xác định sản phẩm cần xóa từ wishlist_id
        $wishlistItem = Wishlist::where('id', $wishlist_id)->firstOrFail();

        // Kiểm tra xem người dùng hiện tại có quyền xóa sản phẩm này hay không (nếu cần)
        // ...

        // Thực hiện xóa sản phẩm
        $wishlistItem->delete();

        // Có thể trả về một phản hồi JSON nếu cần
        return response()->json(['success' => true]);
    }
}
