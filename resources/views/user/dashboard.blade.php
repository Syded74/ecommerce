@extends('layouts.user_without_sidebar')
@section('title', 'User Dashboard')
@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 bg-green-600">
        <h1 class="text-2xl font-bold leading-tight text-white">User Dashboard</h1>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <p class="mb-6">Welcome to your dashboard!</p>
        <h2 class="text-xl font-semibold mb-4">Product List</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="p-4">
                        <h5 class="text-lg font-semibold">{{ $product->name }}</h5>
                        <p class="text-gray-600">{{ $product->description }}</p>
                        <p class="text-gray-800 font-bold mt-2">${{ $product->price }}</p>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-300">Add to Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('cart.view') }}" class="mt-6 inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-300">View Cart</a>
    </div>
</div>
@endsection
\