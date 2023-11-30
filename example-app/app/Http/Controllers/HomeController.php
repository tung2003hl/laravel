<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Food;
use App\Models\Shop;
use App\Models\Wishlist;
use Auth;
use Illuminate\Http\Request;
use App\Services\HomeService;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->middleware('auth');
        $this->homeService = $homeService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    if (auth()->check()) {
        $userId = auth()->id();

        // Sử dụng service để lấy dữ liệu từ wishlist và food
        $homeData = $this->homeService->getHomeData($userId);

        if ($homeData) {
            return view('buyer.home', $homeData);
        } else {
            // Thêm trường hợp trả về giá trị nếu $homeData không tồn tại
            return view('login'); // Hoặc có thể trả về một giá trị khác tùy thuộc vào logic của ứng dụng
        }
    } else {
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
