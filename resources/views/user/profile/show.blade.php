<!-- resources/views/profile/show.blade.php -->
@extends('layouts.user_without_sidebar')

@section('title', 'User Profile')

@section('content')
<div class="min-h-screen bg-gray-100">
    <header class="bg-green-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Dashboard</h1>
          
    </header>
    
    <main class="container mx-auto my-8 p-4 bg-white rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4">Profile</h2>
        <div class="flex items-center mb-4">
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="User Avatar" class="h-16 w-16 rounded-full mr-4">
            @else
                <div class="h-16 w-16 rounded-full bg-green-200 flex items-center justify-center mr-4">
                    <span class="text-2xl text-green-600">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
            @endif
            <div>
                <p class="text-xl font-semibold">{{ auth()->user()->name }}</p>
                <p class="text-gray-600">{{ auth()->user()->email }}</p>
            </div>
        </div>
        <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700">
            Edit Profile
        </a>
    </main>
</div>
@endsection