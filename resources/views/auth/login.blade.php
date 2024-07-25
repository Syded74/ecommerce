@extends('layouts.guest')

@section('content')
<div class="w-full max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden md:max-w-2xl">
    <div class="md:flex">
        <div class="w-full p-4 px-5 py-5">
            <div class="text-center mb-4">
                <h1 class="text-2xl font-bold">LOGIN</h1>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input id="email" type="email" class="w-full p-3 rounded bg-gray-100 @error('email') border border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input id="password" type="password" class="w-full p-3 rounded bg-gray-100 @error('password') border border-red-500 @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="text-gray-700">Remember Me</label>
                    </div>
                </div>

                <div class="mb-4">
                    <button type="submit" class="w-full bg-customGreen text-white py-3 rounded font-bold">Submit</button>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="text-customGreen" href="{{ route('password.request') }}">Forgot Your Password?</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection

