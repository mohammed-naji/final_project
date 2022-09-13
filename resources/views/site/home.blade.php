@extends('site.master')

@section('title', 'Home | ' . env('APP_NAME'))

@php
$name = 'name_' . app()->currentLocale();
@endphp

@section('content')
    <div class="hero-slider">
        @foreach ($slider_products as $product)
            <div class="slider-item th-fullpage hero-area"
                style="background-image: url({{ asset('uploads/products/' . $product->image) }});">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 text-center">
                            <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
                            <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">{{ $product->$name }}
                            </h1>
                            <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                                href="{{ route('site.product', $product->id) }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <section class="product-category section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title text-center">
                        <h2>Product Category</h2>
                    </div>
                </div>
                @foreach ($latest_category as $cat)
                <div class="col-md-6">
                    <div class="category-box category-box-2">
                        <a href="{{ route('site.category', $cat->id) }}">
                            <img src="{{ asset('uploads/categories/'.$cat->image) }}" alt="" />

                            <div class="content">
                                <h3>{{ $cat->$name }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="products section bg-gray">
        <div class="container">
            <div class="row">
                <div class="title text-center">
                    <h2>Trendy Products</h2>
                </div>
            </div>
            <div class="row">

                @foreach ($latest_products as $product)
                <div class="col-md-4">
                    @include('site.parts.product_box')
                </div>
                @endforeach


            </div>
        </div>
    </section>


    <!--
      Start Call To Action
      ==================================== -->
    <section class="call-to-action bg-gray section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="title">
                        <h2>SUBSCRIBE TO NEWSLETTER</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, <br> facilis numquam impedit ut
                            sequi. Minus facilis vitae excepturi sit laboriosam.</p>
                    </div>
                    <div class="col-lg-6 col-md-offset-3">
                        <div class="input-group subscription-form">
                            <input type="text" class="form-control" placeholder="Enter Your Email Address">
                            <span class="input-group-btn">
                                <button class="btn btn-main" type="button">Subscribe Now!</button>
                            </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->

                </div>
            </div> <!-- End row -->
        </div> <!-- End container -->
    </section> <!-- End section -->

    <section class="section instagram-feed">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>View us on instagram</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="instagram-slider" id="instafeed"
                        data-accessToken="IGQVJYeUk4YWNIY1h4OWZANeS1wRHZARdjJ5QmdueXN2RFR6NF9iYUtfcGp1NmpxZA3RTbnU1MXpDNVBHTzZAMOFlxcGlkVHBKdjhqSnUybERhNWdQSE5hVmtXT013MEhOQVJJRGJBRURn">
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
