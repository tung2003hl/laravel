<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use App\Models\User;
use App\Models\Food;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function create()
{
    $userId = auth()->id();
    return view('seller.create_shop')->with('userId',$userId);
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
    $shop->shop_description = $request->shop_description;
    $shop->email = $request->email;
    // Xử lý tập tin logo (nếu được tải lên)
    if ($request->hasFile('logo')) {
        $name = $request->file('logo')->getClientOriginalName();
        $request->file('logo')->storeAs('public/images/', $name);
        $shop->logo = $name;
    }

    // Lưu bản ghi vào cơ sở dữ liệu 
    $shop->save();
    $foods = $shop->foods;
    // Chuyển hướng hoặc trả về phản hồi tùy thuộc vào yêu cầu của bạn
    return redirect()->route('introduce.shop', ['id' => $shop->id])->with('success', 'Cửa hàng đã được tạo thành công.');
}
public function show($id)
{
    $shop = Shop::find($id);

    if (!$shop) {
        abort(404);
    }

    $foods = $shop->foods; // Lấy danh sách sản phẩm của cửa hàng

    return view('seller.introduce_shop', ['shop' => $shop, 'foods' => $foods]);
}
public function delete($id)
{
    // Tìm cửa hàng theo id và kiểm tra xem cửa hàng có tồn tại không
    $shop = Shop::find($id);
    if (!$shop) {
        abort(404); // Hoặc hiển thị lỗi khác tùy theo trường hợp
    }

    // Xóa cửa hàng
    $shop->delete();

    // Chuyển hướng hoặc hiển thị thông báo xóa thành công
    return redirect()->route('seller.home')->with('success', 'Cửa hàng đã được xóa thành công.');
}

public function list($id)
{
    $shop = Shop::find($id);

    if (!$shop) {
        abort(404);
    }

    return view('seller.edit_shop', ['shop' => $shop]);
}

public function update(Request $request, $id)
{
    // Lấy thông tin cửa hàng cần cập nhật từ cơ sở dữ liệu
    $shop = Shop::find($id);

    if (!$shop) {
        abort(404); // Xử lý khi không tìm thấy cửa hàng
    }

    // Validate dữ liệu
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone_num' => 'required|string|max:255',
        'main_food' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'shop_description' => 'nullable|string',
    ]);

    // Cập nhật thông tin cửa hàng
    $shop->update($validatedData);

    // Chuyển hướng trở lại trang hiển thị thông tin cửa hàng
    return redirect()->route('introduce.shop', ['id' => $shop->id])->with('success', 'Thông tin cửa hàng đã được cập nhật thành công.');
}
public function view($shop_id)
    {
        // Retrieve shop details
        $shop = Shop::findOrFail($shop_id);

        // Retrieve food items related to the shop
        $foods = Food::where('shop_id', $shop_id)->get();

        // Pass the data to the shop detail view    
        return view('buyer.shop_detail', compact('shop', 'foods'));

    }
}
