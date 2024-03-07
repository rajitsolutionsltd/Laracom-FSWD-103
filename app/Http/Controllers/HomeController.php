<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
