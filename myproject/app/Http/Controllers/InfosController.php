<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class InfosController extends Controller
{
    public function show($slug)
    {
        # Lấy dữ liệu từ database.
        $detail = DB::table('details')->where('slug',$slug)->first(); 
        
        # Dòng code này sẽ dừng việc thực hiện xử lý và hiển thị giá trị của biến $detail trên màn hình trình duyệt. Rất thích hợp để kiểm tra. Sau khi kiểm tra dữ liệu, Xóa dòng này đi để chạy tiếp xử lý nhé.
        dd($detail);
        
        # Đã giới thiệu ở phần trước. Việc check biến có khác NULL hay không rất quan trọng.
        if (! $detail) {
            abort(404, 'Sorry, that detail was not found.');
        }

        return view('info', [
            'detail' => $detail
        ]);
    }
}
