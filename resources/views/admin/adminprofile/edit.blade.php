<!-- resources/views/profile/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mx-auto my-8 p-4 bg-white rounded shadow-md">
    <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" value="{{ Auth::user()->name }}" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" value="{{ Auth::user()->email }}" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">New Password (leave blank to keep current password)</label>
            <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="profile_photo" class="block text-gray-700 font-semibold mb-2">Profile Photo</label>
            <input type="file" name="profile_photo" id="profile_photo" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <button type="submit" class="px-6 py-2 bg-green-900 text-white rounded-full hover:bg-green-600">Update Profile</button>
    </form>
</div>
@endsection

