@extends('layouts.app')

@section('title', 'Admin Brands')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 admin-sidebar">
            <h4>Admin Dashboard</h4>
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">Products</a>
                <a href="{{ route('admin.brands.index') }}" class="list-group-item list-group-item-action active">Brands</a>
                <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">Categories</a>
                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Users</a>
                <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action">Orders</a>
            </div>
        </div>
        <div class="col-md-9">
            <h1 class="mb-4">Brands</h1>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary mb-4">Add Brand</a>

            <div class="mb-4">
                <a href="{{ route('admin.brands.index', ['filter' => 'active']) }}" class="btn btn-outline-primary">Active</a>
                <a href="{{ route('admin.brands.index', ['filter' => 'inactive']) }}" class="btn btn-outline-secondary">Inactive</a>
                <a href="{{ route('admin.brands.index', ['filter' => 'deleted']) }}" class="btn btn-outline-danger">Deleted</a>
                <a href="{{ route('admin.brands.index', ['filter' => 'all']) }}" class="btn btn-outline-secondary">All</a>
            </div>

            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->description }}</td>
                            <td>{{ $brand->status }}</td>
                            <td>
                                <a href="{{ route('admin.brands.show', $brand->id) }}" class="btn btn-primary btn-sm">View</a>
                                @if($brand->trashed())
                                    <form action="{{ route('admin.brands.restore', $brand->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                    </form>
                                    <form action="{{ route('admin.brands.forceDelete', $brand->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.brands.updateStatus', $brand->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="active" {{ $brand->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $brand->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </form>
                                    <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No brands found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
