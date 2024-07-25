<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel E-Commerce</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-green-400 flex flex-col items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-5xl font-bold  text-white mb-6">Welcome to Laravel E-Commerce</h1>
        <p class="text-2xl text-gray-700 mb-8">Your gateway to a great shopping experience</p>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">Login</a>
            <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300">Register</a>
        </div>
    </div>

    <div class="container mx-auto text-center py-10">
        <h2 class="text-4xl font-bold mb-6">Product List</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="p-4">
                        <h5 class="text-lg font-bold text-gray-900">{{ $product->name }}</h5>
                        <p class="text-gray-600">{{ $product->description }}</p>
                        <p class="text-green-500 font-bold mt-2">${{ $product->price }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
