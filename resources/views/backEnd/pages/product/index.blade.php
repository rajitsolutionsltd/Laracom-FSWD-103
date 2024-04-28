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
                <div class="row d-flex-justify-content-center mt-3">
                    <div class="col-auto">
                        <input name="order_date" type="text" value="{{request()->order_date}}" class="daterangepickr form-control" placeholder="--Select Date--" id="date">
                    </div>

                    <div class="col-auto">
                        <button id="searchProduct" class="btn btn-info">Search</button>
                    </div>
                </div>
                <table class="table table-hover table-striped" id="productTable">
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
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            datatable = $('#productTable').DataTable({
                ajax: {
                    url: '{{ route("admin.product-datasource") }}',
                    type: 'POST',
                    data: function(data){
                        data._token = '{{ csrf_token() }}',
                        data.date = $('#date').val()
                    }
                },
                columns: [
                    { data: 'id' },
                    { data: 'category_id' },
                    { data: 'image' },
                    { data: 'name' },
                    { data: 'price' },
                    { data: 'stock_quantity' },
                    { data: 'created_at' },
                    { data: 'actions', searchable: false, orderable: false}
                ],
                processing: true,
                serverSide: true,
                pageLength: 10
            });
        } );

        $(document).on('click', '#searchProduct', function(e){
            datatable.draw();
        });
    </script>
@endpush
