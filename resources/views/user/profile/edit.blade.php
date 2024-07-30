<!-- resources/views/profile/edit.blade.php -->
@extends('layouts.user_without_sidebar')
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
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p class="font-bold">Error</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" value="{{ old('name', Auth::user()->name) }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" value="{{ old('email', Auth::user()->email) }}" required>
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
            @if(Auth::user()->profile_photo)
                <img src="{{ Storage::url(Auth::user()->profile_photo) }}" alt="Current Profile Photo" class="w-32 h-32 object-cover rounded-full mb-2">
            @endif
            <input type="file" name="profile_photo" id="profile_photo" class="w-full p-2 border border-gray-300 rounded" accept="image/*">
            <img id="photo_preview" src="#" alt="Photo Preview" class="w-32 h-32 object-cover rounded-full mt-2 hidden">
        </div>
        <button type="submit" class="px-6 py-2 bg-green-900 text-white rounded-full hover:bg-green-600">Update Profile</button>
    </form>
</div>

<script>
    document.getElementById('profile_photo').onchange = function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                document.getElementById('photo_preview').src = fr.result;
                document.getElementById('photo_preview').classList.remove('hidden');
            }
            fr.readAsDataURL(files[0]);
        }
    }
</script>
@endsection