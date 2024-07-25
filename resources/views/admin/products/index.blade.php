@extends('layouts.app')

@section('title', 'Admin Products')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 admin-sidebar">
            <h4>Admin Dashboard</h4>
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action active">Products</a>
                <a href="{{ route('admin.brands.index') }}" class="list-group-item list-group-item-action">Brands</a>
                <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">Categories</a>
                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Users</a>
                <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action">Orders</a>
            </div>
        </div>
        <div class="col-md-9">
            <h1 class="mb-4">Products</h1>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-4">Add Product</a>
            <div class="mb-4">
                <a href="{{ route('admin.products.index', ['filter' => 'deleted']) }}" class="btn btn-danger">Deleted Products</a>
                <a href="{{ route('admin.products.index', ['filter' => 'all']) }}" class="btn btn-secondary">All Products</a>
            </div>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td><img src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->name }}" width="50"></td>
                            <td>
                                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary btn-sm">View</a>
                                @if($product->trashed())
                                    <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                    </form>
                                    <form action="{{ route('admin.products.forceDelete', $product->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
