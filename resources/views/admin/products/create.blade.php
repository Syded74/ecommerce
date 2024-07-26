@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-6">Create Product</h1>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
            <input type="text" name="name" id="name" class="form-input mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" id="description" class="form-textarea mt-1 block w-full border border-gray-300 rounded-lg p-2" required></textarea>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
            <input type="text" name="price" id="price" class="form-input mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
        </div>
        <div class="mb-4">
            <label for="brand_id" class="block text-gray-700 font-bold mb-2">Brand</label>
            <select name="brand_id" id="brand_id" class="form-select mt-1 block w-full border border-gray-300 rounded-lg p-2">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-bold mb-2">Category</label>
            <select name="category_id" id="category_id" class="form-select mt-1 block w-full border border-gray-300 rounded-lg p-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">Image</label>
            <input type="file" name="image" id="image" class="form-input mt-1 block w-full border border-gray-300 rounded-lg p-2">
        </div>
        <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-green-700">Create Product</button>
    </form>
</div>
@endsection
