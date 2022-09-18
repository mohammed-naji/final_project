<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function cart()
    {
        return view('site.cart');
    }

    public function delete_cart($id)
    {
        Cart::destroy($id);

        return redirect()->back();
    }

    public function checkout()
    {
        $total = Auth::user()->carts()->sum(DB::raw('quantity * price'));
        // dd($total);
        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=$total" .
                    "&currency=USD" .
                    "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseData = json_decode($responseData, true);
        // dd($responseData);
        $id = $responseData['id'];
        return view('site.checkout', compact('id'));
    }

    public function payment(Request $request)
    {
        $resourcePath = $request->resourcePath;
        $url = "https://eu-test.oppwa.com$resourcePath";
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseData = json_decode( $responseData, true );

        $code = $responseData['result']['code'];
        // dd($code);
        if($code == '000.100.110'){
            echo 'Done';
            // Create new Order

            // add cart to order items

            // create payment recodr

            // decrease product quantity

            // delete cart items

            // redirect to success page
        }else {
            echo 'Error';
            // redirect to errro page
        }
    }
}
