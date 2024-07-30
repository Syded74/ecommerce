<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - My App</title>
    @vite('resources/css/app.css')
    <style>
        .rotate-180 {
            transform: rotate(180deg);
            transition: transform 0.2s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <nav class="bg-green-600 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-white text-xl font-bold">Dashboard</span>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Add User Dashboard Button -->
                    <a href="{{ route('user.dashboard') }}" class="bg-white text-green-600 px-3 py-2 rounded-md text-sm font-medium hover:bg-green-100 transition duration-150 ease-in-out">
                        User Dashboard
                    </a>
                    <div class="relative mr-4">
                        <input type="text" class="border rounded-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Search">
                        <svg class="h-5 w-5 absolute top-3 right-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 10-14 0 7 7 0 0014 0z"></path>
                        </svg>
                    </div>
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button class="flex items-center text-white focus:outline-none" @click="dropdownOpen = !dropdownOpen">
                            <span>{{ Auth::user()->name }}</span>
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="User Avatar" class="h-8 w-8 rounded-full ml-2">
                            @else
                                <img src="{{ asset('path/to/default-avatar.png') }}" alt="User Avatar" class="h-8 w-8 rounded-full ml-2">
                            @endif
                            <svg class="h-5 w-5 ml-1" :class="{'rotate-180': dropdownOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </nav>
   
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @yield('content')
    </main>
    @vite('resources/js/app.js')
</body>
</html>
