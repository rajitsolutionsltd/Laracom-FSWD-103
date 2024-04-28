<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;

class BkashPaymentController extends Controller
{
    public function index()
    {
        $orderId = session()->get('order_id');
        $order = Order::find($orderId);

        $inv = uniqid();
        $data['intent'] = 'sale';
        $data['mode'] = '0011';
        $data['payerReference'] = $inv;
        $data['currency'] = 'BDT';
        $data['amount'] = $order->total_amount;
        $data['merchantInvoiceNumber'] = $inv;
        $data['callbackURL'] = config("bkash.callbackURL");
        $data_json = json_encode($data);

        $response =  BkashPaymentTokenize::cPayment($data_json);

        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error', $response['statusMessage']);
    }

    public function callBack(Request $request)
    {
        if ($request->status == 'success') {
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            if (!$response) {
                $response =  BkashPaymentTokenize::queryPayment($request->paymentID);
            }
            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                $orderId = session()->get('order_id');
                $order = Order::find($orderId);
                $order->status = 'Paid';
                $order->save();

                session()->forget('order_id');
                return redirect()->to('/dashboard')->with('success', 'Your Payment has been successfully completed')->with('clear_cart', true);
            }
        } else if ($request->status == 'cancel') {
            return redirect()->route('order.payment')->with('error', 'Your payment is canceled');
        } else {
            return redirect()->route('order.payment')->with('error', 'Your transaction is failed');
        }
    }
}
