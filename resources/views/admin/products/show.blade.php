@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>
            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p><strong>Brand:</strong> {{ $product->brand->name }}</p>
            <p><strong>Category:</strong> {{ $product->category->name }}</p>
            @if($product->image)
                <img src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->name }}" width="200">
            @endif
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary mt-3">Back to Products</a>
        </div>
    </div>
</div>
@endsection
