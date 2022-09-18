@extends('site.master')

@section('title', 'Shop | ' . env('APP_NAME'))

@section('styles')

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Checkout</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('site.index') }}">Home</a></li>
                            <li class="active">checkout</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-wrapper">
        <div class="checkout shopping">
           <div class="container">
              <div class="row">
                 <div class="col-md-8">

                    <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $id }}"></script>
                    <form action="{{ route('site.payment') }}" class="paymentWidgets" data-brands="VISA MASTER AMEX MADA"></form>


                    {{-- <div id="smart-button-container">
                        <div style="text-align: center;">
                          <div id="paypal-button-container"></div>
                        </div>
                      </div>
                    <script src="https://www.paypal.com/sdk/js?client-id=AXIzjs4AK6Fq_YMtGksv9XL51eQnD7ZxSw3y9PCixgd1wX8GMObAml8t00xdtBqtnjalvXg_n8Qf3gYI&currency=USD" data-sdk-integration-source="button-factory"></script>
                    <script>
                      function initPayPalButton() {
                        paypal.Buttons({
                          style: {
                            shape: 'rect',
                            color: 'blue',
                            layout: 'vertical',
                            label: 'checkout',

                          },

                          createOrder: function(data, actions) {
                            return actions.order.create({
                              purchase_units: [{"description":"This is test product","amount":{"currency_code":"USD","value":100}}]
                            });
                          },

                          onApprove: function(data, actions) {
                            return actions.order.capture().then(function(orderData) {

                              // Full available details
                              console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                              // Show a success message within this page, e.g.
                              const element = document.getElementById('paypal-button-container');
                              element.innerHTML = '';
                              element.innerHTML = '<h3>Thank you for your payment!</h3>';

                              // Or go to another URL:  actions.redirect('thank_you.html');

                            });
                          },

                          onError: function(err) {
                            console.log(err);
                          }
                        }).render('#paypal-button-container');
                      }
                      initPayPalButton();
                    </script> --}}

                 </div>
                 <div class="col-md-4">
                    <div class="product-checkout-details">
                       <div class="block">
                          <h4 class="widget-title">Order Summary</h4>
                          <div class="media product-card">
                             <a class="pull-left" href="product-single.html">
                                <img class="media-object" src="images/shop/cart/cart-1.jpg" alt="Image">
                             </a>
                             <div class="media-body">
                                <h4 class="media-heading"><a href="product-single.html">Ambassador Heritage 1921</a></h4>
                                <p class="price">1 x $249</p>
                                <span class="remove">Remove</span>
                             </div>
                          </div>
                          <div class="discount-code">
                             <p>Have a discount ? <a data-toggle="modal" data-target="#coupon-modal" href="#!">enter it here</a></p>
                          </div>
                          <ul class="summary-prices">
                             <li>
                                <span>Subtotal:</span>
                                <span class="price">$190</span>
                             </li>
                             <li>
                                <span>Shipping:</span>
                                <span>Free</span>
                             </li>
                          </ul>
                          <div class="summary-total">
                             <span>Total</span>
                             <span>$250</span>
                          </div>
                          <div class="verified-icon">
                             <img src="images/shop/verified.png">
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>


@stop
