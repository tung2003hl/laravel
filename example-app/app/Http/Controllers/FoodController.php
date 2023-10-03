<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Shop;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

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
    public function showCart()
    {
        $carts = session()->get(key:'cart');
        return view('buyer.shop_cart',compact('carts'));
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


}
