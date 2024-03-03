@extends('backEnd.layouts.masters')
@section('page-title', 'Category Add')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Add New Category</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.category.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
