@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Manage Products</a>
    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary mb-3">Manage Brands</a>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Manage Categories</a>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create User</a>
    
    <h2>Product List</h2>
    <div class="row product-list">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">${{ $product->price }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
