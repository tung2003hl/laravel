<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Category;
use App\Models\Food;
use Termwind\Components\Dd;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class RatingController extends Controller
{
    public function saveRating(Request $request)
{
    // Xử lý và kiểm tra dữ liệu đầu vào ở đây
    $request->validate([
        'product_rating' => 'required|numeric|min:1|max:5', // Kiểm tra đánh giá hợp lệ
        'comment' => 'nullable|string', // Nhận xét có thể là một chuỗi không bắt buộc
    ]);

    // Lưu đánh giá vào cơ sở dữ liệu
    $rating = new Rating();
    $rating->shop_id = $request->shop_id; // Đảm bảo bạn có một trường shop_id trong bảng ratings
    $rating->user_id = auth()->user()->id; // Lấy ID của người dùng hiện tại (đã đăng nhập)
    $rating->rating = $request->product_rating;
    $rating->comment = $request->comment;
    $rating->save();

    // Thực hiện thêm xử lý khác nếu cần

    return redirect()->back()->with('success', 'Đánh giá của bạn đã được lưu thành công.');
}
}
