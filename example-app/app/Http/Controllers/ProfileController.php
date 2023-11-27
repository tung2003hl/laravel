<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDetail;
use Termwind\Components\Dd;
use App\Models\Shop;
use Carbon\Carbon;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show()
{
    $user = auth()->user();
    $cartCount = $this->getCartCount();
    

    if (!$user) {
        return abort(404);
    }
    $orderIds = $user->orders->pluck('id')->unique()->toArray();

    // Đếm số lượng id đơn đặt hàng duy nhất
    $totalQuantity = count($orderIds);

    $wishlistItems = $this->getWishlistItems(auth()->id());


    $orders = $user->orders;

    // Lấy thông tin về order_detail và food cho mỗi đơn đặt hàng
    $orders = $user->orders ->load('orderDetails.food.shop');
    

    // Sử dụng hàm compact để truyền các biến vào view
    return view('profile.profile', compact('wishlistItems','user', 'orders','cartCount','totalQuantity'));
}
public function getCartCount()
{
    $cart = session()->get('cart');
    $totalQuantity = 0;
    if (auth()->check()) {
    if ($cart) {
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }
    }

    return $totalQuantity;
}
}
    
    public function show_detail($order_id){
        $order = Order::find($order_id);

        if(!$order){
            return abort(404);
        }
        $orderDetail = OrderDetail::where('order_id',$order_id)->get();

        return view('profile.order_detail',compact('order','orderDetail'));
    }

    public function show_profile(){
        $user = auth()->user();
        

        return view('profile.profile_detail',compact('user'));
    }
    public function update(Request $request)
    {
        // Validate and update user profile data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'gender' => 'required|in:0,1', // Ví dụ: 0 là Nam, 1 là Nữ
            'mobile_no' => 'required|string',
        ]);

        // Lấy user hiện tại
        $user = auth()->user();

        // Cập nhật thông tin người dùng
        $user->update($validatedData);
        $user = auth()->user();
        

        return view('profile.profile_detail',compact('user'));
    }

    public function show_pass(){
        return view('profile.change_password'); 
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Kiểm tra xem current_password có đúng với password hiện tại không
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('show.password')->with('error', 'Current password is incorrect.');
        }

        // Cập nhật mật khẩu mới
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile.detail')->with('success', 'Password changed successfully');
    }
    public function WishListShowCount($id)
    {
        $wishlistcount = Wishlist::where('user_id', $id)->count();

    return view('profile.profile', compact('wishlistcount'));
    }

    protected function getWishlistItems($userId)
    {
        // Lấy dữ liệu từ bảng wishlist và food với điều kiện liên kết food_id và id
        return DB::table('wishlists')
                    ->join('food', 'wishlists.food_id', '=', 'food.id')
                    ->select('food.name', 'food.price','food.image_url')
                    ->where('wishlists.user_id', $userId)
                    ->get();
    }

    public function seller_show()
{
    $user = auth()->user();
    $cartCount = $this->getCartCount();
    

    if (!$user) {
        return abort(404);
    }
    $orderIds = $user->orders->pluck('id')->unique()->toArray();

    // Đếm số lượng id đơn đặt hàng duy nhất
    $totalQuantity = count($orderIds);

    $wishlistItems = $this->getWishlistItems(auth()->id());


    $orders = $user->orders;

    // Lấy thông tin về order_detail và food cho mỗi đơn đặt hàng
    $orders = $user->orders ->load('orderDetails.food.shop');
    

    // Sử dụng hàm compact để truyền các biến vào view
    return view('seller.profile', compact('wishlistItems','user', 'orders','cartCount','totalQuantity'));
}


}
