<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDetail;
use Termwind\Components\Dd;
use App\Models\Shop;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
{
    // Lấy dữ liệu từ session "cart" (nếu có)
    $cart = session()->get('cart');

    if ($cart) {
        // Nếu session "cart" có giá trị, thực hiện xử lý và trả về view "checkout.blade.php"
        return view('buyer.checkout', compact('cart'));
    } else {
        // Nếu session "cart" không có giá trị, gửi thông báo và chuyển hướng hoặc xử lý khác
        return redirect()->back()->with('message', 'Không có sản phẩm trong giỏ hàng.');
    }
}
    public function vnpay_payment(){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
    $vnp_TmnCode = "8TD5FYOP";//Mã website tại VNPAY 
    $vnp_HashSecret = "RIVTPCSJCEMHVLEETAMAEZXMSRYGZTQZ"; //Chuỗi bí mật
    
    $vnp_TxnRef = '1256'; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
    $vnp_OrderInfo = 'Thanh toán đơn hàng';
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = 20000 * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );
    
    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }
    
    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    
    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }

    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required',
            'name' => 'required',
            'phone_number' => 'required|string|max:15',
            'email_address' => 'required|email|max:255',
            'note' => 'string|max:255',
    
        ]);
        $total=0;
        $carts = session()->get(key:'cart');
        foreach($carts as $cartItem){        
                  $total +=$cartItem['price'] * $cartItem['quantity'];
        }

        $user = auth()->user();
        $user_id = $user->id;
        // Lưu thông tin đơn hàng vào bảng "order"
        $order = new Order();// Cung cấp giá trị mới cho trường 'user_id'
        $order->user_id = $user_id;
        $order->delivery_address = $request->input('address');
        $order->receiver_name = $request->input('name');
        $order->phone_no = $request->input('phone_number');
        $order->email = $request->input('email_address');
        $order->total_price = $total;
        $order->order_date = Carbon::now();
        $order->note=$request->input('note'); // Điền giá trị của $total từ form vào đây
        $order->save();

        // Lưu chi tiết đơn hàng vào bảng "order_detail" cho mỗi sản phẩm trong giỏ hàng
        $cart = session()->get(key:'cart');
        foreach ($cart as $carts) {           
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->food_id = $carts['id'];
            $orderDetail->name = $carts['name'];
            $orderDetail->quantity = $carts['quantity'];
            $orderDetail->price = $carts['quantity'] * $carts['price'];
            $orderDetail->image = $carts['image'];
            $orderDetail->save();
        }
        
        // Sau khi lưu dữ liệu, có thể thực hiện các tác vụ khác như chuyển hướng hoặc thông báo thành công
        return view('buyer.confirm_order', compact('order', 'orderDetail'));
    
    
}
}
