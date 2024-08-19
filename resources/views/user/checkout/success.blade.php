<!-- resources/views/user/checkout/success.blade.php -->
@extends('layouts.user_without_sidebar')

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold mb-6 text-green-600">Order Placed Successfully!</h2>
        <p class="text-xl mb-4">Thank you for your purchase.</p>
        <p class="mb-4">Your order has been received and is now being processed.</p>
        <a href="{{ route('user.dashboard') }}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Return to Dashboard
        </a>
    </div>
</div>
@endsection