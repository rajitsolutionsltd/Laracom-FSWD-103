@extends('backEnd.layouts.masters')
@section('page-title', 'Product Add')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="row">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3>Add New Product</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">

                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Price</label>
                    <input type="text" class="form-control" name="price">

                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Stock Quantity</label>
                    <input type="text" class="form-control" name="stock_quantity">

                    @error('stock_quantity')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Select Category</label>
                    <select name="category" class="form-select">
                        <option>--Select--</option>
                        @foreach($categoryOptions as $category_id => $name)
                        <option value="{{ $category_id }}">{{ $name }}</option>
                        @endforeach
                    </select>

                    @error('category')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control summernote"></textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
        height: 120,
        });
    });
</script>
@endpush