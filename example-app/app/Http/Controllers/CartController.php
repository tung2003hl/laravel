<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function removeItem(Request $request, $product)
    {
        // Implement your logic here to remove the specified product from the cart.
        // You may need to manipulate the session or database data based on your cart implementation.

        // Example: Removing an item from a session-based cart
        $cart = $request->session()->get('cart', []);

        // Find and remove the product from the cart array (assuming products are identified by their keys)
        if (isset($cart[$product])) {
            unset($cart[$product]);
        }

        // Update the cart session data
        $request->session()->put('cart', $cart);

        // Redirect back to the cart page or wherever you need
        return redirect()->route('show.cart'); // You should have a route for viewing the cart.
    }
}
