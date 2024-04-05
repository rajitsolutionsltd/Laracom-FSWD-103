@extends('frontEnd.layouts.masters')

@section('content')
<div class="container" style="padding-top:150px;">
    <div class="row">
        <div class="col-12">
            <div class="ltn__checkout-single-content mt-50">
                <h4 class="title-2">Order Details</h4>
                <div class="ltn__checkout-single-content-info">
                    <table class="table">
                        <tr>
                            <th>Photo</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>

                        @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>
                                <img src="{{ asset($detail->product->image ? Storage::url($detail->product->image) : 'assets/img/no-product-image.png') }}" alt="#" style="height: 100px;">
                            </td>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->price }}</td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="3" align="right"><strong>Total Amount: </strong></td>
                            <td>{{ $order->total_amount }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="ltn__checkout-single-content mt-50">
                <h4 class="title-2">Choose Payment Method</h4>
                <div class="ltn__checkout-single-content-info">
                    <div class="row">
                        <div class="col-2">
                            <a href="{{ url('bkash/payment') }}">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="https://www.logo.wine/a/logo/BKash/BKash-bKash-Logo.wine.svg" alt="">
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-2">
                            <a href="">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="https://www.logo.wine/a/logo/Nagad/Nagad-Horizontal-Logo.wine.svg" alt="">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection