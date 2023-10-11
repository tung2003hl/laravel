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

class ProfileController extends Controller
{
    public function show()
{
    $user = auth()->user();

    if (!$user) {
        return abort(404);
    }

    $orders = $user->orders;

    // Lấy thông tin về order_detail và food cho mỗi đơn đặt hàng
        $orders = $user->orders ->load('orderDetails.food.shop');
    

    // Sử dụng hàm compact để truyền các biến vào view
    return view('profile.profile', compact('user', 'orders'));
}
    
    public function show_detail($order_id){
        $order = Order::find($order_id);

        if(!$order){
            return abort(404);
        }
        $orderDetail = OrderDetail::where('order_id',$order_id)->get();

        return view('profile.order_detail',compact('order','orderDetail'));
    }

}
