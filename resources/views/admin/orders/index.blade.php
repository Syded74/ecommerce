@extends('layouts.app')

@section('title', 'Admin Orders')

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
            <h1 class="mb-4">Orders</h1>

            <div class="mb-4">
                <a href="{{ route('admin.orders.index', ['filter' => 'all']) }}" class="btn btn-outline-secondary">All</a>
                <a href="{{ route('admin.orders.index', ['filter' => 'deleted']) }}" class="btn btn-outline-danger">Deleted</a>
            </div>

            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>${{ $order->total }}</td>
                            <td>
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="inprogress" {{ $order->status == 'inprogress' ? 'selected' : '' }}>In Progress</option>
                                    </select>
                                </form>
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                @if($order->trashed())
                                    <form action="{{ route('admin.orders.restore', $order->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                    </form>
                                    <form action="{{ route('admin.orders.forceDelete', $order->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
