@extends('backEnd.layouts.masters')
@section('page-title', 'Category Edit')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Edit Category</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.category.update', $category->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value={{ $category->name }}>

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
