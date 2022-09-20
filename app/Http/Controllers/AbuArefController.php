<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AbuArefController extends Controller
{
    public function abu_aref()
    {
        $categories = Category::all();

        return view('site.abu_aref', compact('categories'));
    }

    public function abu_aref_data(Request $request)
    {
        return Category::find($request->id)->products;
    }
}
