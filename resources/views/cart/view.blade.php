<!-- view.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Shopping Cart</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $id => $details)
                <tr>
                    <td>{{ $details['name'] }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>${{ $details['price'] }}</td>
                    <td>${{ $details['price'] * $details['quantity'] }}</td>
                    <td>
                        <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('order.place') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>
@endsection
