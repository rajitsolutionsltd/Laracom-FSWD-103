<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Karim007\LaravelBkash\Facade\BkashPayment;

class BkashPaymentController extends Controller
{
    public function index()
    {
        $cartItems = collect(session()->get('cartItems'));
        $totalPrice = $cartItems->sum('price');
        session()->put('invoice_amount', $totalPrice);

        return BkashPayment::getToken();
    }
}
