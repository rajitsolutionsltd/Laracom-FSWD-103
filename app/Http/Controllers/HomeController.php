<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        return view('frontEnd.pages.home', compact('categories'));
    }
}
