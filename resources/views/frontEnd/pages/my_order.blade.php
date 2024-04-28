@extends('frontEnd.layouts.masters')

@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="card-title">My Orders</div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#Order No</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>Order Date</th>
                        <th>Delivery Status</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{!! getPaymentStatus($order->status) !!}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{!! getDeliveryStatus($order->delivery_status) !!}</td>
                            <td>
                                <a href="{{ route('show-order', $order->id) }}" class="btn btn-sm btn-info">Show Order</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
