@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shopping Cart</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($cart as $id => $details)
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{ $details['image'] }}" alt="{{ $details['name'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $details['name'] }}</h5>
                        <p class="card-text">${{ $details['price'] }}</p>
                        <p class="card-text">Quantity: {{ $details['quantity'] }}</p>
                        <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger">Remove</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('order.place') }}" class="btn btn-primary mt-3">Place Order</a>
</div>
@endsection
