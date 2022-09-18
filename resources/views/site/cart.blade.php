@extends('site.master')

@section('title', 'Shop | ' . env('APP_NAME'))

@section('styles')

<style>

button {
    border: 0;
    background: transparent
}

</style>

@stop

@section('content')
<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Cart</h1>
					<ol class="breadcrumb">
						<li><a href="{{ route('site.index') }}">Home</a></li>
						<li class="active">cart</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="page-wrapper">
    <div class="cart shopping">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="block">
              <div class="product-list">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="">Name</th>
                        <th class="">Price</th>
                        <th class="">Quantity</th>
                        <th class="">Total</th>
                        <th class="">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (auth()->user()->carts as $cart)
                        <tr class="">
                            <td class="">
                            <div class="product-info">
                                <img width="80" src="{{ asset('uploads/products/'.$cart->product->image) }}" alt="">
                                <a href="{{ route('site.product', $cart->product_id) }}">{{ $cart->product->$name }}</a>
                            </div>
                            </td>
                            <td>${{ $cart->price }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td class="">
                                ${{ number_format($cart->quantity * $cart->price, 2) }}</td>
                            <td class="">
                                <form action="{{ route('site.delete_cart', $cart->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="product-remove">Remove</button>
                                </form>
                            {{-- <a class="product-remove" href="{{ route('site.delete_cart', $cart->id) }}">Remove</a> --}}
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <a href="checkout.html" class="btn btn-main pull-right">Checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@stop
