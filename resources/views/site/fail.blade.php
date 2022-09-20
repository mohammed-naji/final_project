@extends('site.master')

@section('title', 'Payment Failed | ' . env('APP_NAME'))


@section('content')

<div class="page-wrapper">
    <div class="cart shopping">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="block">
              <div class="alert alert-danger text-center">
                <h3>Payment Failed</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@stop
