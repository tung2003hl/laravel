<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth;

class WishlistController extends Controller
{
    public function WishListShow($food_id)
    {
        $wish = Wishlist::where('food_id',$food_id)->where('user_id',Auth::user()->id)->first();   
        if(isset($wish)){
        session()->flash('message','Product Wishlist already exists');
        return back();
        } 
        Wishlist::insert([
            'user_id' => Auth ::id(),
            'food_id' => $food_id
        ]);
        session()->flash('message','Wishlist Inserted Successfully');
        return back();
    }

    public function WishListShowCount($id)
    {
        $wishlistcount = Wishlist::count($id);

        return view('profile.profile', compact('wishlistcount'));
    }
}
