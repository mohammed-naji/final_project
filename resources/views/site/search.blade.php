@extends('site.master')

@section('title', 'Shop | ' . env('APP_NAME'))

@section('content')
<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
                    <form action="{{ route('site.search') }}" method="get"><input type="search" name="s" class="form-control" placeholder="Search..." value="{{ request()->s }}"></form>
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
	</div>
</section>
@stop
