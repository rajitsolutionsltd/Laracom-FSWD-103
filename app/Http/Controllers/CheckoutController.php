<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Billing;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function billingDetailForm()
    {
        return view('frontEnd.pages.billing_detail');
    }

    public function billingStore(Request $request)
    {
        $cartItems = collect(session()->get('cartItems'));
        $totalPrice = $cartItems->sum('price');

        DB::beginTransaction();

        try {
            $billing = new Billing;
            $billing->fname = $request->fname;
            $billing->lname = $request->lname;
            $billing->phone = $request->phone;
            $billing->address1 = $request->address1;
            $billing->address2 = $request->address2;
            $billing->user_id = auth()->user()->id;
            $billing->save();

            $order = new Order;
            $order->user_id = auth()->user()->id;
            $order->order_date = now();
            $order->total_amount = $totalPrice;
            $order->status = 'Pending';
            $order->save();

            foreach ($cartItems as $item) {
                $detail = new OrderDetail;
                $detail->product_id = $item->id;
                $detail->price = $item->price;
                $detail->quantity = $item->quantity;
                $detail->order_id = $order->id;
                $detail->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
