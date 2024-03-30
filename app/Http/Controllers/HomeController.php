<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        return view('frontEnd.pages.home', compact('categories'));
    }

    public function productViewModal($productId)
    {
        $product = Product::find($productId);

        $html = view('frontEnd.pages.particles.product_view_modal', compact('product'))->render();
        $response = [
            'html' => $html,
        ];
        return response()->json($response);
    }

    public function checkoutView()
    {
        return view('frontEnd.pages.checkout');
    }

    public function processCheckout(Request $request)
    {
        $response = [];
        if (Auth::check()) {
            $response = [
                'redirect_url' => route('billing-details'),
                'success' => true
            ];

            $cartItems = json_decode($request->cartItems);

            session()->put('cartItems', $cartItems);
        } else {
            $response = [
                'redirect_url' => route('customer.login'),
                'success' => false
            ];
        }


        return \response()->json($response);
    }
}
