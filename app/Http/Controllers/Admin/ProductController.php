<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->orderByDesc('id')->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'name_en', 'name_ar')->get();
        $product = new Product();
        return view('admin.products.create', compact('categories', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate Data
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,svg,gif',
            'content_en' => 'required',
            'content_ar' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Upload Images
        $img = $request->file('image');
        $img_name = rand(). time().$img->getClientOriginalName();
        $img->move(public_path('uploads/products'), $img_name);


        // Store To Database
        Product::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'image' => $img_name,
            'content_en' => $request->content_en,
            'content_ar' => $request->content_ar,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        // Redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $product = Product::findOrFail($id);
        // $product = Product::find($id);

        // if(!$product) {
        //     abort(404);
        // }

        // dd($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::select('id', 'name_en', 'name_ar')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate Data
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg,gif',
            'content_en' => 'required',
            'content_ar' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);

        // Upload Images
        $img_name = $product->image;
        if($request->hasFile('image')) {
            File::delete(public_path('uploads/products/'.$product->image));
            $img = $request->file('image');
            $img_name = rand(). time().$img->getClientOriginalName();
            $img->move(public_path('uploads/products'), $img_name);
        }

        // Store To Database
        $product->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'image' => $img_name,
            'content_en' => $request->content_en,
            'content_ar' => $request->content_ar,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        // Redirect
        return redirect()->route('admin.products.index')->with('msg', 'Product updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        File::delete(public_path('uploads/products/'.$product->image));

        $product->delete();

        return redirect()->route('admin.products.index')->with('msg', 'Product deleted successfully')->with('type', 'danger');
    }

    public function trash()
    {
        $products = Product::onlyTrashed()->orderByDesc('id')->paginate(10);

        return view('admin.products.trash', compact('products'));
    }

    public function restore($id)
    {
        // Product::onlyTrashed()->find($id)->update(['deleted_at' => null]);
        Product::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.products.index')->with('msg', 'Product restored successfully')->with('type', 'warning');
    }

    public function forcedelete($id)
    {
        Product::onlyTrashed()->find($id)->forcedelete();

        return redirect()->route('admin.products.index')->with('msg', 'Product deleted permanintly successfully')->with('type', 'danger');
    }
}
