<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $slider_products = Product::orderByDesc('id')->limit(3)->get();
        $latest_category = Category::orderByDesc('id')->limit(2)->get();
        $latest_products = Product::orderByDesc('id')->limit(9)->offset(3)->get();

        return view('site.home', compact('slider_products', 'latest_category', 'latest_products'));
    }

    public function shop()
    {
        $products = Product::orderByDesc('id')->paginate(9);
        return view('site.shop', compact('products'));
    }

    public function category($id)
    {
        $category = Category::with('products')->find($id);
        return view('site.category', compact('category'));
    }

    public function search(Request $request)
    {
        $products = Product::orderByDesc('id')->where('name_'.app()->currentLocale(), 'like', '%'.$request->s.'%')->get();
        return view('site.search', compact('products'));
    }

    public function product($id)
    {
        $product = Product::with('reviews', 'category')->findOrfail($id);

        $next = Product::where('id', '>', $product->id)->first();
        $prev = Product::select('id')->where('id', '<', $product->id)->orderByDesc('id')->first();

        $related = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();

        return view('site.product', compact('product', 'next', 'prev', 'related'));
    }
}
