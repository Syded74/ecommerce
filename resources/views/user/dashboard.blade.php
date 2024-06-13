@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Dashboard</h1>
    <p>Welcome to your dashboard!</p>

    <h2>Product List</h2>
    <div class="row product-list">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->name }}">
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
