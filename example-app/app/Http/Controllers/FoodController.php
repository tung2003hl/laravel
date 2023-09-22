<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Shop;
use App\Models\Category;

class FoodController extends Controller
{
    public function create(Request $request,$shop_id)
{
    $categories = Category::all();
    return view('create_food',['categories' => $categories,'shop_id' => $shop_id]);
}

public function store(Request $request)
{
    // Validate dữ liệu từ form
    $validatedData = $request->validate([
        'shop_id' => 'required',
        'category_id' =>'required',
        'name' => 'required',
        'price' => 'required',
        'image_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'required',
    ]);
    $name_image = $request->file('image_url')->getClientOriginalName();
    $request->file('image_url')->storeAs('public/images/',$name_image);

    // Lưu dữ liệu vào cơ sở dữ liệu
    $food = new Food();
    $food->shop_id = $request->input('shop_id');
    $food->category_id = $request->input('category_id');
    $food->name = $request->input('name');
    $food->price = $request->input('price');
    $food->description = $request->input('description');
    $food->image_url = $name_image;

    // Xử lý lưu hình ảnh (nếu được cung cấp)

    $food->save();
    $shop = Shop::find($request->input('shop_id'));
    $foods = Food::where('shop_id', $request->input('shop_id'))->get();
    
    // Chuyển hướng hoặc hiển thị thông báo thành công
    return redirect()->route('introduce.shop', ['id' => $food->shop_id])->with('success', 'Sản phẩm đã được thêm thành công.');
}

public function delete($id)
{
    // Tìm sản phẩm theo id và kiểm tra xem sản phẩm có tồn tại không
    $food = Food::find($id);
    if (!$food) {
        abort(404); // Hoặc hiển thị lỗi khác tùy theo trường hợp
    }

    // Lấy giá trị shop_id từ sản phẩm
    $shopId = $food->shop_id;

    // Xóa sản phẩm
    $food->delete();

    // Chuyển hướng lại đến route 'introduce.shop' với thông báo thành công và shop_id
    return redirect()->route('introduce.shop', ['id' => $shopId])->with('success', 'Sản phẩm đã được xóa thành công.');
}

}
