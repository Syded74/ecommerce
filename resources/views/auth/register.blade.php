@extends('layouts.guest')

@section('content')
<div class="w-full max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden md:max-w-2xl">
    <div class="md:flex">
        <div class="w-full p-4 px-5 py-5">
            <div class="text-center mb-4">
                <h1 class="text-2xl font-bold">Register</h1>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input id="name" type="text" class="w-full p-3 rounded bg-gray-100 @error('name') border border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email Address</label>
                    <input id="email" type="email" class="w-full p-3 rounded bg-gray-100 @error('email') border border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input id="password" type="password" class="w-full p-3 rounded bg-gray-100 @error('password') border border-red-500 @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password-confirm" class="block text-gray-700">Confirm Password</label>
                    <input id="password-confirm" type="password" class="w-full p-3 rounded bg-gray-100" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="mb-4">
                    <button type="submit" class="w-full bg-customGreen text-white py-3 rounded font-bold">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
