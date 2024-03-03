@extends('backEnd.layouts.masters')
@section('page-title', 'Product List')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Product List</h3>

                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Add New</a>
            </div>

            <div class="card-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock Quantity</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    <img width="100" class="img-fluid"
                                        src="{{ asset($product->image ? Storage::url($product->image) : 'assets/img/no-product-image.png') }}">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td>{{ $product->created_at }}</td>

                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href="#" class="btn btn-danger"
                                            onclick="
                                        event.preventDefault();
                                        document.getElementById('delete-product-{{ $product->id }}').submit();
                                        ">Delete</a>

                                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="post"
                                            id="delete-product-{{ $product->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {!! $products->links() !!}
            </div>
        </div>
    </div>
@endsection
