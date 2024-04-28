<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backEnd.pages.product.index');
    }

    public function datasource(Request $request)
    {
        $model = Product::where(function ($query) use ($request) {
            $created_at = $request->date;
            $created_at = explode(' to ', $created_at);
            if (!empty($created_at) && \count($created_at) > 1) {
                $query->whereDate('created_at', '>=', $created_at[0]);
                $query->whereDate('created_at', '<=', $created_at[1]);
            } elseif (!empty($created_at) && $created_at[0] != '') {
                $query->whereDate('created_at', $created_at[0]);
            }
        });

        return DataTables::of($model)
            ->editColumn('category_id', function ($product) {
                return $product->category->name;
            })
            ->editColumn('created_at', function ($product) {
                return date('Y-m-d', strtotime($product->created_at));
            })
            ->editColumn('actions', 'backEnd.pages.product.action_buttons')
            ->editColumn('image', function ($product) {
                $image = asset($product->image ? Storage::url($product->image) : 'assets/img/no-product-image.png');
                $html = "<img width='100' class='img-fluid' src='$image'>";
                return $html;
            })
            ->escapeColumns(['actions'])
            ->rawColumns(['actions'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryOptions = Category::categoryOptions();
        return view('backEnd.pages.product.create', \compact('categoryOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'stock_quantity' => 'required|numeric',
            'category' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif,bmp',

        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->description = $request->description;
        $product->category_id = $request->category;

        $destination = 'files/';
        $file = $request->file('image');
        $fileName = \fileUpload($file, $destination);

        $product->image = $fileName;
        $product->save();

        return \redirect()->back()->with('success', 'Successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categoryOptions = Category::categoryOptions();
        return view('backEnd.pages.product.edit', \compact('product', 'categoryOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'stock_quantity' => 'required|numeric',
            'category' => 'required',
            'image' => 'sometimes|mimes:jpg,jpeg,png,gif,bmp',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock_quantity = $request->stock_quantity;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $destination = 'files/';
        $fileName = \fileUpdate($product->image, $request->file('image'), $destination);

        $product->image = $fileName;
        $product->save();

        return \redirect()->back()->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        \fileDelete($product->image);
        $product->delete();
        return \redirect()->back()->with('warning', 'Successfully Deleted');
    }
}
