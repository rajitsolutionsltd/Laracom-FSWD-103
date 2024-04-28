@extends('backEnd.layouts.masters')
@section('page-title', 'Product Add')

@section('content')
<div class="row">
    <div class="col-md-8">
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

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                @if($order->delivery_status == 'Delivered')
                <p class="alert alert-success mt-3">Delivered Successfully</p>
                @elseif($order->status == 'Paid')
                    <form action="{{ route('admin.order.accept') }}" method="post" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Select Delivery Status</label>
                            <input name="order_id" type="hidden" value="{{ $order->id }}">
                            <select name="delivery_status" class="form-select">
                                <option>--Select--</option>
                                @foreach (getDeliveryOptions() as $status)
                                    <option value="{{$status}}" @if ($order->delivery_status == $status) selected @endif>
                                        {{ $status }}</option>
                                @endforeach
                            </select>

                            @error('delivery_status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                @else
                    <p class="alert alert-warning mt-3">Not Paid</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection