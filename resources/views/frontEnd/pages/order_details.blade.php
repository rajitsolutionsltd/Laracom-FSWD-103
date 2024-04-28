@extends('frontEnd.layouts.masters')

@section('content')
<div class="row">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title">Order Details</div>
            <div>
                <h4>Delivery Status: {!! getDeliveryStatus($order->delivery_status) !!}</h4>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->price }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td><strong>Grand Total:</strong></td>
                        <td>{{ $order->orderDetails->sum('quantity') }}</td>
                        <td>{{ $order->orderDetails->sum('price') }}</td>
                    </tr>

                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
