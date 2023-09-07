<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function create()
{
    $userId = auth()->id();
    return view('create_shop')->with('userId',$userId);
}

public function store(Request $request)
{
    $name = $request->file('logo')->getClientOriginalName();
    $request->file('logo')->storeAs('public/images/',$name);

    // Lưu dữ liệu vào cơ sở dữ liệu
    // Ví dụ: Tạo một bản ghi mới trong bảng Shop
    $shop = new Shop;
    $shop->owner_id = $request->owner_id;
    $shop->name = $request->name;
    $shop->address = $request->address;
    $shop->phone_num = $request->phone_num  ;
    $shop->main_food = $request->main_food;
    $shop->shop_description = $request->shop_description;
    $shop->logo = $name;
    $shop->email = $request->email;
    // Xử lý tập tin logo (nếu được tải lên)
    

    // Lưu bản ghi vào cơ sở dữ liệu 
    $shop->save();
    // Chuyển hướng hoặc trả về phản hồi tùy thuộc vào yêu cầu của bạn
    return view('introduce_shop', ['shop' => $shop]);
}
public function show($id)
{
    $shop = Shop::find($id); // Tìm cửa hàng theo id

    // Kiểm tra xem cửa hàng có tồn tại hay không
    if (!$shop) {
        abort(404); // Nếu không tìm thấy, hiển thị lỗi 404
    }

    return view('introduce_shop', ['shop' => $shop]);
}
}
