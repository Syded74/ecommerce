@extends('layouts.user_without_sidebar')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-3xl font-bold mb-6">Checkout</h2>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Your name</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Your email</label>
                    <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="country">Country</label>
                    <input type="text" id="country" name="country" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="city">City</label>
                    <input type="text" id="city" name="city" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="vat_number">VAT number</label>
                    <input type="text" id="vat_number" name="vat_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="shipping_address">Shipping Address</label>
                    <input type="text" id="shipping_address" name="shipping_address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="billing_address">Billing Address</label>
                    <input type="text" id="billing_address" name="billing_address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-green-700 transition duration-300">Proceed to Payment</button>
            </div>
        </form>
    </div>
</div>
@endsection