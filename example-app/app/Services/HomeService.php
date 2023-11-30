<?php
namespace App\Services;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Food;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;


class HomeService
{
    public function getWishlistItems($userId)
    {
        return DB::table('wishlists')
            ->join('food', 'wishlists.food_id', '=', 'food.id')
            ->select('wishlists.id as wishlist_id', 'food.name', 'food.price', 'food.image_url')
            ->where('wishlists.user_id', $userId)
            ->get();
    }

    public function getWishlistCount($userId)
    {
        return Wishlist::where('user_id', $userId)->count();
    }

    public function getHomeData($userId)
    {
        // Thêm các phương thức khác nếu cần

        if (auth()->check()) {
            $food = Food::join('categories', 'food.category_id', '=', 'categories.id')
                ->select('food.*', 'categories.category_name')
                ->get();

            $wishlistItems = $this->getWishlistItems($userId);

            $shopName = Shop::pluck('name', 'id');

            $wishlistcount = $this->getWishlistCount($userId);

            return compact('wishlistItems', 'food', 'shopName', 'wishlistcount');
        }

        return null;
    }
}