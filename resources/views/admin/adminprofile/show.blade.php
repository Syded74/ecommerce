<!-- resources/views/profile/show.blade.php -->
@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container mx-auto my-8 p-4 bg-white rounded shadow-md">
    <h1 class="text-2xl font-bold mb-4">Profile</h1>

    <div class="flex items-center mb-4">
        @if(Auth::user()->profile_photo)
            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="User Avatar" class="h-16 w-16 rounded-full mr-4">
        @else
            <img src="{{ asset('path/to/default-avatar.png') }}" alt="User Avatar" class="h-16 w-16 rounded-full mr-4">
        @endif
        <div>
            <p class="text-xl font-semibold">{{ Auth::user()->name }}</p>
            <p class="text-gray-600">{{ Auth::user()->email }}</p>
        </div>
    </div>

    <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-green-900 text-white rounded-full hover:bg-green-300">Edit Profile</a>
</div>
@endsection
