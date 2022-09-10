@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Add New Product | ' . env('APP_NAME'))

@section('content')
content_en	content_ar	price	sale_price	quantity
    <h1>Add new Product</h1>
    @include('admin.errors')
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>English Name</label>
                    <input type="text" name="name_en" placeholder="English Name" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Arabic Name</label>
                    <input type="text" name="name_ar" placeholder="Arabic Name" class="form-control">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image"  class="form-control">
        </div>

        <div class="mb-3">
            <label>Parent</label>
            {{ config('app.transname') }}
            <select name="parent_id" class="form-control">

                <option value="">Select</option>
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->$name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success px-5">Add</button>
    </form>

@stop
