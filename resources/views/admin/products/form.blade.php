<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label>English Name</label>
            <input type="text" name="name_en" placeholder="English Name" class="form-control" value="{{ $product->name_en }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label>Arabic Name</label>
            <input type="text" name="name_ar" placeholder="Arabic Name" class="form-control" value="{{ $product->name_ar }}">
        </div>
    </div>
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="file" name="image"  class="form-control">
    @if ($product->image)
    <img width="80" src="{{ asset('uploads/products/'.$product->image) }}" alt="">
    @endif

</div>

<div class="mb-3">
    <label>English Content</label>
    <textarea class="myedit" placeholder="English Content" name="content_en">{{ $product->content_en }}</textarea>
</div>

<div class="mb-3">
    <label>Arabic Content</label>
    <textarea class="myedit" placeholder="Arabic Content" name="content_ar">{{ $product->content_ar }}</textarea>
</div>

<div class="mb-3">
    <label>Price</label>
    <input type="text" name="price" placeholder="Price" class="form-control" value="{{ $product->price }}">
</div>

<div class="mb-3">
    <label>Sale Price</label>
    <input type="text" name="sale_price" placeholder="Sale Price" class="form-control" value="{{ $product->sale_price }}">
</div>

<div class="mb-3">
    <label>Quantity</label>
    <input type="text" name="quantity" placeholder="Quantity" class="form-control" value="{{ $product->quantity }}">
</div>

<div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control">

        <option value="">Select</option>
        @foreach ($categories as $item)
            <option {{ $product->category_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->$name }}</option>
        @endforeach
    </select>
</div>
