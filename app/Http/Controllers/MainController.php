<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $slider_products = Product::orderByDesc('id')->limit(3)->get();
        return view('website.home', compact('slider_products'));
    }
}
