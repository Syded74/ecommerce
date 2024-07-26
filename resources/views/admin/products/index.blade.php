@extends('layouts.app')

@section('title', 'Admin Products')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Products</h1>
        <div>
            <a href="{{ route('admin.products.create') }}" class="bg-green-900 text-white px-4 py-2 rounded">Add Product</a>
            <a href="{{ route('admin.products.index', ['filter' => 'deleted']) }}" class="bg-danger text-white px-4 py-2 rounded">Deleted Products</a>
            <a href="{{ route('admin.products.index', ['filter' => 'all']) }}" class="bg-green-900 text-white px-4 py-2 rounded">All Products</a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full bg-white">
            <thead class="bg-green-900 text-white">
                <tr>
                    <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID</th>
                    <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Name</th>
                    <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Description</th>
                    <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Price</th>
                    <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Brand</th>
                    <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Category</th>
                    <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Image</th>
                    <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($products as $product)
                    <tr>
                        <td class="py-3 px-4">{{ $product->id }}</td>
                        <td class="py-3 px-4">{{ $product->name }}</td>
                        <td class="py-3 px-4">{{ $product->description }}</td>
                        <td class="py-3 px-4">${{ number_format($product->price, 2) }}</td>
                        <td class="py-3 px-4">{{ $product->brand->name }}</td>
                        <td class="py-3 px-4">{{ $product->category->name }}</td>
                        <td class="py-3 px-4"><img src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover"></td>
                        <td class="py-3 px-4">
                            <a href="{{ route('admin.products.show', $product->id) }}" class="bg-green-900 text-white px-2 py-1 rounded inline-block">View</a>
                            @if($product->trashed())
                                <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-secondary text-white px-2 py-1 rounded">Restore</button>
                                </form>
                                <form action="{{ route('admin.products.forceDelete', $product->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-danger text-white px-2 py-1 rounded">Delete Permanently</button>
                                </form>
                            @else
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-danger text-white px-2 py-1 rounded" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
