@extends('site.master')

@section('title', 'Product | ' . env('APP_NAME'))

@section('description', Str::words(strip_tags($product->$content), 40, '...'))
@section('keywords', $product->$name)

@section('content')
<section class="single-product">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<ol class="breadcrumb">
					<li><a href="{{ route('site.index') }}">Home</a></li>
					<li><a href="{{ route('site.shop') }}">Shop</a></li>
					<li class="active">{{ $product->$name }}</li>
				</ol>
			</div>
			<div class="col-md-6">
				<ol class="product-pagination text-right">
                    @if ($next)
                    <li><a href="{{ route('site.product', $next->id) }}"><i class="tf-ion-ios-arrow-left"></i> Next </a></li>
                    @endif

                    @if ($prev)
                    <li><a href="{{ route('site.product', $prev->id) }}">Preview <i class="tf-ion-ios-arrow-right"></i></a></li>
                    @endif

				</ol>
			</div>
		</div>
		<div class="row mt-20">
			<div class="col-md-5">
				<div class="single-product-slider">
					<img style="max-width: 100%" src='{{ asset('uploads/products/'.$product->image) }}' />
				</div>
			</div>
			<div class="col-md-7">

                @if (session('msg'))
                    <div class="alert alert-success">
                        {{ session('msg') }}
                    </div>
                @endif

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
				<div class="single-product-details">
					<h2>{{ $product->$name }}</h2>
                    @php
                    $rating = $product->reviews()->where('local', app()->currentLocale())->avg('star');
                    @endphp

                    @foreach(range(1,5) as $i)
                        <span class="fa-stack" style="width:1em">
                            <i class="far fa-star fa-stack-1x"></i>

                            @if($rating >0)
                                @if($rating >0.5)
                                    <i class="fas fa-star fa-stack-1x"></i>
                                @else
                                    <i class="fas fa-star-half fa-stack-1x"></i>
                                @endif
                            @endif
                            @php $rating--; @endphp
                        </span>
                    @endforeach

					<p class="product-price">${{ $product->price }}</p>

					<p class="product-description mt-20">
                        {!! Str::words($product->$content, 15, '...') !!}
                    </p>
					{{-- <div class="color-swatches">
						<span>color:</span>
						<ul>
							<li>
								<a href="#!" class="swatch-violet"></a>
							</li>
							<li>
								<a href="#!" class="swatch-black"></a>
							</li>
							<li>
								<a href="#!" class="swatch-cream"></a>
							</li>
						</ul>
					</div>
					<div class="product-size">
						<span>Size:</span>
						<select class="form-control">
							<option>S</option>
							<option>M</option>
							<option>L</option>
							<option>XL</option>
						</select>
					</div> --}}

					<form action="{{ route('site.add_to_cart') }}" method="POST">

                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="product-quantity">
                            <span>Quantity:</span>
                            <div class="product-quantity-slider">
                                <input id="product-quantity" type="text" value="1" name="quantity">
                            </div>
                        </div>

                        <div class="product-category">
                            <span>Categories:</span>
                            <ul>
                                <li><a href="{{ route('site.category', $product->category_id) }}">{{ $product->category->$name }}</a></li>
                            </ul>
                        </div>
                        <button class="btn btn-main mt-20">Add To Cart</button>
                    </form>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="tabCommon mt-20">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Details</a></li>
						<li class=""><a data-toggle="tab" href="#reviews" aria-expanded="false">Reviews ({{ $product->reviews()->where('local', app()->currentLocale())->count() }})</a></li>
					</ul>
					<div class="tab-content patternbg">
						<div id="details" class="tab-pane fade active in">
							<h4>Product Description</h4>
							{!! $product->$content !!}
						</div>
						<div id="reviews" class="tab-pane fade">
							<div class="post-comments">
						    	<ul class="media-list comments-list m-bot-50 clearlist">
                                    @foreach ($product->reviews()->where('local', app()->currentLocale())->get() as $review)
                                    {{-- @if ($review->local == app()->currentLocale()) --}}
                                    <li class="media">

								        <a class="pull-left" href="#!">
								            <img class="media-object comment-avatar" src="https://ui-avatars.com/api/?name={{ $review->user->name }}" alt="" width="50" height="50" />
								        </a>

								        <div class="media-body">
								            <div class="comment-info">
								                <h4 class="comment-author">
								                    <a href="#!">{{ $review->user->name }}</a>

								                </h4>
								                <time datetime="2013-04-06T13:53">{{ $review->created_at->format('F d, Y,') }} at {{ $review->created_at->format('h:i') }}</time>
								                <a class="comment-button" href="#!"><i class="tf-ion-star"></i>{{ $review->star }}</a>
								            </div>

								            <p>
								                {{ $review->comment }}
								            </p>
								        </div>

								    </li>
                                    {{-- @endif --}}

                                    @endforeach
							</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="products related-products section">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>Related Products</h2>
			</div>
		</div>
		<div class="row">
            @foreach ($related as $product)
            <div class="col-md-3">
				@include('site.parts.product_box')
			</div>
            @endforeach


		</div>
	</div>
</section>
@stop
