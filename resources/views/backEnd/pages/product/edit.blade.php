@extends('backEnd.layouts.masters')
@section('page-title', 'Product Edit')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Edit Product</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="text" class="form-control" name="price" value="{{ $product->price }}">

                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Stock Quantity</label>
                        <input type="text" class="form-control" name="stock_quantity"
                            value="{{ $product->stock_quantity }}">

                        @error('stock_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Select Category</label>
                        <select name="category" class="form-select">
                            <option>--Select--</option>
                            @foreach ($categoryOptions as $category_id => $name)
                                <option value="{{ $category_id }}" @if ($product->category_id == $category_id) selected @endif>
                                    {{ $name }}</option>
                            @endforeach
                        </select>

                        @error('category')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <div style="width: 100px" class="mb-2">
                            <img src="{{ Storage::url($product->image) }}" alt="" class="img-fluid">
                        </div>
                        <input type="file" class="form-control" name="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea name="description" rows="4" class="form-control summernote">
                            {{ $product->description }}
                        </textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
