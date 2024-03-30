@extends('frontEnd.layouts.masters')

@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
        data-bg="img/bg/9.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                        <div class="section-title-area ltn__section-title-2">
                            <h6 class="section-subtitle ltn__secondary-color">// Welcome to Laracom</h6>
                            <h1 class="section-title white-color">Cart</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- SHOPING CART AREA START -->
    <div class="liton__shoping-cart-area mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="shoping-cart-total mt-50">
                            <h4>Cart Totals</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><strong>Order Total</strong></td>
                                        <td><strong class="total-amount">00</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="btn-wrapper text-right text-end">
                                <a href="#" class="theme-btn-1 btn btn-effect-1" onclick="processCheckout()">Proceed
                                    to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOPING CART AREA END -->
@endsection
