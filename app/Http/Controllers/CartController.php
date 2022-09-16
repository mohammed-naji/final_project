<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'quantity' => 'gt:0',
            'product_id' => 'exists:products,id'
        ]);

        $product = Product::select('price')->where('id', $request->product_id)->first();

        $cart = Cart::where('product_id', $request->product_id)->where('user_id', Auth::id())->first();

        if($cart) {
            $cart->update(['quantity' => $cart->quantity + $request->quantity]);
        }else {
            Cart::create([
                'price' => $product->price,
                'quantity' => $request->quantity,
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->back()->with('msg', 'Product added to cart successfully');
    }
}
