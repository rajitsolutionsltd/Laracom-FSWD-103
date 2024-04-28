<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function myOrderIndex()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('frontEnd.pages.my_order', \compact('orders'));
    }

    public function showOrder($order_id)
    {
        $order = Order::with('orderDetails')->find($order_id);
        return view('frontEnd.pages.order_details', \compact('order'));
    }
}
