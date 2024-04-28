@extends('backEnd.layouts.masters')
@section('page-title', 'Order List')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.order.search') }}" method="get">
                    <div class="row d-flex-justify-content-center mt-3">
                        <div class="col-auto">
                            <select name="user_id" id="user_id" class="form-select">
                                <option value="">--Select User</option>
                                @foreach (App\Models\User::all() as $user)
                                    <option {{ request()->user_id == $user->id ? 'selected': ''}} value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="col-auto">
                            <select name="payment_status" id="payment_status" class="form-select">
                                <option value="">--Select Payment Status</option>
                                @foreach (getPaymentOptions() as $item)
                                    <option value="{{ $item }}" {{ request()->payment_status == $item ? 'selected': ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-auto">
                            <input name="order_date" type="text" value="{{request()->order_date}}" class="daterangepickr form-control" placeholder="--Select Date--">
                        </div>
    
                        <div class="col-auto">
                            <button type=submit class="btn btn-info">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Order List</h3>
            </div>

            <div class="card-body">
                <table class="table">
                <thead>
                    <tr>
                        <th>#Order No</th>
                        <th>User</th>
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
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{!! getPaymentStatus($order->status) !!}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{!! getDeliveryStatus($order->delivery_status) !!}</td>
                            <td>
                                <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-info">Show Order</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

                {!! $orders->links() !!}
            </div>
        </div>
    </div>
@endsection
