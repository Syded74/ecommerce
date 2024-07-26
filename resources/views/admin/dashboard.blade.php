@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2 class="mt-6 text-2xl font-bold">Admin Dashboard</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img class="w-full h-48 object-cover" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                <div class="p-4">
                    <h5 class="text-lg font-bold text-gray-800">{{ $product->name }}</h5>
                    <p class="text-gray-600">{{ $product->description }}</p>
                    <p class="text-success font-bold mt-2">${{ $product->price }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
