@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Edit Category | ' . env('APP_NAME'))

@section('content')

    <h1>Edit Category</h1>
    @include('admin.errors')
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>English Name</label>
            <input type="text" name="name_en" placeholder="English Name" class="form-control" value="{{ $category->name_en }}">
        </div>

        <div class="mb-3">
            <label>Arabic Name</label>
            <input type="text" name="name_ar" placeholder="Arabic Name" class="form-control" value="{{ $category->name_ar }}">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image"  class="form-control">
            <img width="80" src="{{ asset('uploads/categories/'.$category->image) }}" alt="">
        </div>

        <div class="mb-3">
            <label>Parent</label>
            {{ config('app.transname') }}
            <select name="parent_id" class="form-control">

                <option value="">Select</option>
                @foreach ($categories as $item)
                    <option {{ $category->parent_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->$name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success px-5">Update</button>
    </form>

@stop
