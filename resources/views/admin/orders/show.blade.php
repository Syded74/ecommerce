<!-- resources/views/admin/orders/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order Details</h1>
    <div class="card">
        <div class="card-header">
            Order #{{ $order->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Order Details</h5>
            <p class="card-text"><strong>User:</strong> {{ $order->user->name }}</p>
            <p class="card-text"><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $order->status }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
            <a href="{{ route('admin.orders') }}" class="btn btn-primary">Back to Orders</a>
        </div>
    </div>
</div>
@endsection
