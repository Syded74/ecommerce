@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Create Product</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->brand ? $product->brand->name : 'N/A' }}</td>
                    <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                    <td><img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="100"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
