<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Shop;
use Illuminate\Http\Request;
use Termwind\Components\Dd;
use App\Models\OrderDetail;
use App\Models\Order;

class FoodController extends Controller
{
    public function create(Request $request,$shop_id)
{
    $categories = Category::all();
    return view('seller.create_food',['categories' => $categories,'shop_id' => $shop_id]);
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
// public function search(Request $request)
//     {
        
//         $searchTerm = $request->input('searchTerm');

//         // Tìm kiếm các sản phẩm có tên giống với từ khóa tìm kiếm
//         $food = Food::join('categories', 'food.category_id', '=', 'categories.id')
//         ->select('food.*', 'categories.category_name')
//         ->where('food.name', 'like', '%' . $searchTerm . '%')
//         ->get();

//         // Trả về view hiển thị kết quả tìm kiếm
//         $shopName = Shop::pluck('name','id');
//         return view('buyer.home', compact('food', 'shopName'));
//     }

public function search(Request $request)
{
    $searchTerm = $request->input('searchTerm');

    // Lấy URL hiện tại
    $currentUrl = $request->path();
    dd($currentUrl);    

    if ($currentUrl === 'food') {
        $food = $this->searchFood($searchTerm);
        $shopName = Shop::pluck('name', 'id');
        return view('buyer.home', compact('food', 'shopName'));
    } elseif ($currentUrl === 'drink') {
        $food = $this->searchDrink($searchTerm);
        $shopName = Shop::pluck('name', 'id');
        return view('buyer.home', compact('food', 'shopName'));
    } elseif ($currentUrl === 'flower') {
        $food = $this->searchFlower($searchTerm);
        $shopName = Shop::pluck('name', 'id');
        return view('buyer.home', compact('food', 'shopName'));
    } elseif ($currentUrl === 'market') {
        $food = $this->searchMarket($searchTerm);
        $shopName = Shop::pluck('name', 'id');
        return view('buyer.home', compact('food', 'shopName'));
    } else {
        // Xử lý các localhost khác nếu cần
        $food = Food::join('categories', 'food.category_id', '=', 'categories.id')
        ->select('food.*', 'categories.category_name')
        ->where('food.name', 'like', '%' . $searchTerm . '%')
        ->get();

        // Trả về view hiển thị kết quả tìm kiếm
        $shopName = Shop::pluck('name','id');
        return view('buyer.home', compact('food', 'shopName'));
    }
}

private function searchFood($searchTerm)
{
    // Thực hiện tìm kiếm sản phẩm trong localhost '/food'
    $food = Food::join('categories', 'food.category_id', '=', 'categories.id')
    ->select('food.*', 'categories.category_name')
    ->where('food.name', 'like', '%' . $searchTerm . '%')
    ->where('food.category_id', '=', 1)
    ->get();

    
    return $food;
}

private function searchDrink($searchTerm)
{
    // Thực hiện tìm kiếm sản phẩm trong localhost '/drink'
    $food = Food::join('categories', 'food.category_id', '=', 'categories.id')
    ->select('food.*', 'categories.category_name')
    ->where('food.name', 'like', '%' . $searchTerm . '%')
    ->where('food.category_id', '=', 2)
    ->get();
    
    return $food;
}

private function searchMarket($searchTerm)
{
    // Thực hiện tìm kiếm sản phẩm trong localhost '/drink'
    $food = Food::join('categories', 'food.category_id', '=', 'categories.id')
    ->select('food.*', 'categories.category_name')
    ->where('food.name', 'like', '%' . $searchTerm . '%')
    ->where('food.category_id', '=', 4)
    ->get();
    
    return $food;
}

private function searchFlower($searchTerm)

{
    // Thực hiện tìm kiếm sản phẩm trong localhost '/drink'
    $food = Food::join('categories', 'food.category_id', '=', 'categories.id')
    ->select('food.*', 'categories.category_name')
    ->where('food.name', 'like', '%' . $searchTerm . '%')
    ->where('food.category_id', '=', 3)
    ->get();
    
    return $food;
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
    public function addToCart($id)
    {   
        $food = Food::find($id);
        $cart = session()->get(key:'cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        } else {
            $cart[$id]=[
                'id'=>$id,
                'image' => $food->image_url,
                'name' => $food->name,
                'price' => $food->price,
                'quantity' => 1
            ];
        }
        session()->put('cart',$cart);
        return response()->json([
            'code' => 200,
            'message =>success'
        ], status:200);
    }
    public function getCartCount()
{
    $cart = session()->get('cart');
    $totalQuantity = 0;

    if ($cart) {
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }
    }

    return $totalQuantity;
}
    public function showCart()
    {
        $cartCount = $this->getCartCount();
        $carts = session()->get(key:'cart');
        return view('buyer.shop_cart', compact('carts', 'cartCount'));

    }
    // public function updateCart(Request $request ){
    // if($request->id && $request->quantity){
    //     $carts = session()->get('cart');
    //     $carts[$request->id]['quantity']=$request->quantity;
    //     session()->put('cart',$carts);
    //     $carts = session()->get('cart');
    //     // dd($carts);


    //     return redirect()->back()->with('success','Remove from Cart');

    // }
    // }
    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }

    // public function deleteCart(Request $request){
    //     if($request->id){
    //         $carts = session()->get('cart');
    //         unset($carts[$request->id]);
    //         session()->put('cart',$carts);
    //         $carts = session()->get('cart');
    //         // dd($carts);
    
    
    //         $cartComponent = view('buyer.components.cart_component',compact('carts')) ->render();
    //         return response()->json(['cart_component' =>$cartComponent,'code'=>200],status:200); 
    
    //     }
    // }
    public function updateCart(Request $request,$id )
    {
        $food = Food::find($id);
        $cart = session()->get('cart');
        if($request->change_to === 'down'){     
            if(isset($cart[$id])){
                  if($cart[$id]['quantity']>1){
                    $cart[$id]['quantity']--;
                    return $this->setSessionAndReturnResponse($cart);
                  }else{
                    return $this->deleteCart($id);
                  }

            }
        }else{
            if($request->change_to === 'up'){
                $cart[$id]['quantity']++;
                return $this->setSessionAndReturnResponse($cart);
            }

        }
         
    }
    protected function setSessionAndReturnResponse($cart)
    {
        session()->put('cart',$cart);
        return redirect()->route('show.cart')->with('success',"Added to Cart");
    }
        // public function addToCart(Food $food){
        //     $cart = session()->get('cart');
        //     if(!$cart){
        //         $cart = [
        //             $food->id=>[
        //                 'name' => $food->name,
        //                 'quantity' =>1,
        //                 'price' =>$food->price,
        //                 'image' =>$food->image_url
        //             ]
        //             ];
        //             session()->put('cart',$cart); 
        //     }
        //     if(isset($cart[$food->id])){
        //         $cart[$food->id]['quantity']++;
        //         session()->put('cart',$cart);
        //         return redirect()->route('show.cart')->with('success',"Added to Cart");
        //     }

        //     $cart[$food->id]= [
        //         'name' => $food->name,
        //                 'quantity' =>1,
        //                 'price' =>$food->price,
        //                 'image' =>$food->image_url
        //     ];

        //     session()->get('cart',$cart);
        //     return redirect()->route('show.cart')->with('success',"Added to Cart");
            

        // }
        public function deleteCart($id){
            $cart = session()->get('cart');
            if(isset($cart[$id])){
                unset($cart[$id]);
                session()->put('cart',$cart);
            }
            return redirect()->back()->with('success','Remove from Cart');

        }
        public function getFood(){
            $food = Food::join('categories', 'food.category_id', '=', 'categories.id')
            ->where('food.category_id', 1) // Lọc các sản phẩm có category_id = 1
            ->select('food.*', 'categories.category_name')
            ->get();
         // Hoặc bạn có thể thay thế bằng truy vấn tùy chỉnh

            $shopName = Shop::pluck('name','id');
            return view('buyer.home', compact('food', 'shopName')); // Lấy ra các sản phẩm có category_id bằng 1
        }
        public function getDrink(){
            $food = Food::join('categories', 'food.category_id', '=', 'categories.id')
            ->where('food.category_id', 2) // Lọc các sản phẩm có category_id = 1
            ->select('food.*', 'categories.category_name')
            ->get();
         // Hoặc bạn có thể thay thế bằng truy vấn tùy chỉnh

            $shopName = Shop::pluck('name','id');
            return view('buyer.home', compact('food', 'shopName')); // Lấy ra các sản phẩm có category_id bằng 1
        }
         
        public function getFlower(){
            $food = Food::join('categories', 'food.category_id', '=', 'categories.id')
            ->where('food.category_id', 4) // Lọc các sản phẩm có category_id = 1
            ->select('food.*', 'categories.category_name')
            ->get();
         // Hoặc bạn có thể thay thế bằng truy vấn tùy chỉnh

            $shopName = Shop::pluck('name','id');
            return view('buyer.home', compact('food', 'shopName')); // Lấy ra các sản phẩm có category_id bằng 1
        

        }
        public function getMarket(){
            $food = Food::join('categories', 'food.category_id', '=', 'categories.id')
            ->where('food.category_id', 3) // Lọc các sản phẩm có category_id = 1
            ->select('food.*', 'categories.category_name')
            ->get();
         // Hoặc bạn có thể thay thế bằng truy vấn tùy chỉnh

            $shopName = Shop::pluck('name','id');
            return view('buyer.home', compact('food', 'shopName')); // Lấy ra các sản phẩm có category_id bằng 1
        }
        


}
