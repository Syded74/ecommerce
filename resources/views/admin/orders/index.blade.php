@extends('layouts.app')

@section('title', 'Admin Orders')

@section('content')

        <div class="col-span-3">
            <h1 class="text-2xl font-semibold mb-6">Orders</h1>

            <div class="mb-4">
                <a href="{{ route('admin.orders.index', ['filter' => 'all']) }}" class="bg-green-900  text-white px-4 py-2 rounded hover:bg-secondary-dark">All</a>
                <a href="{{ route('admin.orders.index', ['filter' => 'deleted']) }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Deleted</a>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-green-900 text-white">
                        <tr>
                            <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID</th>
                            <th class="w-2/12 py-3 px-4 uppercase font-semibold text-sm">User</th>
                            <th class="w-2/12 py-3 px-4 uppercase font-semibold text-sm">Total</th>
                            <th class="w-2/12 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                            <th class="w-2/12 py-3 px-4 uppercase font-semibold text-sm">Created At</th>
                            <th class="w-3/12 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($orders as $order)
                            <tr>
                                <td class="w-1/12 py-3 px-4">{{ $order->id }}</td>
                                <td class="w-2/12 py-3 px-4">{{ $order->user->name }}</td>
                                <td class="w-2/12 py-3 px-4">${{ $order->total }}</td>
                                <td class="w-2/12 py-3 px-4">
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select bg-gray-200 rounded" onchange="this.form.submit()">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="inprogress" {{ $order->status == 'inprogress' ? 'selected' : '' }}>In Progress</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="w-2/12 py-3 px-4">{{ $order->created_at }}</td>
                                <td class="w-3/12 py-3 px-4 flex space-x-2">
                                    @if($order->trashed())
                                        <form action="{{ route('admin.orders.restore', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Restore</button>
                                        </form>
                                        <form action="{{ route('admin.orders.forceDelete', $order->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete Permanently</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
