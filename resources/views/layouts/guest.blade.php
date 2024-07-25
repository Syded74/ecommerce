<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="bg-gradient-to-tr from-green-300 to-green-600 h-screen w-full flex justify-center items-center">
        <div class="bg-green-600 w-full sm:w-1/2 md:w-9/12 lg:w-1/2 shadow-md flex flex-col md:flex-row items-center justify-center rounded-lg">
            <div class="w-full md:w-1/2 hidden md:flex flex-col justify-center items-center text-center text-white">
                <h1 class="text-3xl">Hello</h1>
                <p class="text-5xl font-extrabold">Welcome!</p>
            </div>
            <div class="bg-white w-full md:w-1/2 flex flex-col items-center py-32 px-8">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
