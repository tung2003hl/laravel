<?php

namespace App\Http\Controllers;
use App\Models\Shop;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function create()
{
    return view('create_shop');
}

public function store(Request $request)
{


    // Lưu dữ liệu vào cơ sở dữ liệu
    // Ví dụ: Tạo một bản ghi mới trong bảng Shop
    $shop = new Shop;
    $shop->owner_id = $request->owner_id;
    $shop->name = $request->name;
    $shop->address = $request->address;
    $shop->phone_num = $request->phone_num  ;
    $shop->main_food = $request->main_food;

    // Xử lý tập tin logo (nếu được tải lên)
    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('public/logos');
        $shop->logo = $logoPath;
    }

    // Lưu bản ghi vào cơ sở dữ liệu 
    $shop->save();
    // Chuyển hướng hoặc trả về phản hồi tùy thuộc vào yêu cầu của bạn
    return redirect('/seller/home');
}
}
