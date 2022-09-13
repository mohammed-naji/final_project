@extends('site.master')

@section('title', 'Shop | ' . env('APP_NAME'))

@section('content')
<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Shop</h1>
					<ol class="breadcrumb">
						<li><a href="index-2.html">Home</a></li>
						<li class="active">shop</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="products section">
	<div class="container">
		<div class="row">
            @foreach ($products as $product)
            <div class="col-md-4">
                @include('site.parts.product_box')
            </div>
            @endforeach
        </div>

        <div style="display: flex; justify-content: center">
            {{ $products->links() }}
        </div>
	</div>
</section>
@stop
