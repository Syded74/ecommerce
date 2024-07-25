@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 admin-sidebar">
            <h4>Admin Dashboard</h4>
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">Products</a>
                <a href="{{ route('admin.brands.index') }}" class="list-group-item list-group-item-action">Brands</a>
                <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">Categories</a>
                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Users</a>
                <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action active">Orders</a>
            </div>
        </div>
        <div class="col-md-9">
            <h1 class="mb-4">Order Details</h1>
            <div class="card">
                <div class="card-header">
                    Order #{{ $order->id }}
                </div>
                <div class="card-body">
                    <p><strong>User:</strong> {{ $order->user->name }}</p>
                    <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                    <p><strong>Status:</strong> {{ $order->status }}</p>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Back to Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
