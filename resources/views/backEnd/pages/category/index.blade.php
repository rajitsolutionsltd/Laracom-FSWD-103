@extends('backEnd.layouts.masters')
@section('page-title', 'Category List')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Category List</h3>

                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add New</a>
            </div>

            <div class="card-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at }}</td>

                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.category.edit', $category->id) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href="#" class="btn btn-danger"
                                            onclick="
                                        event.preventDefault();
                                        document.getElementById('delete-category-{{ $category->id }}').submit();
                                        ">Delete</a>

                                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="post"
                                            id="delete-category-{{ $category->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
