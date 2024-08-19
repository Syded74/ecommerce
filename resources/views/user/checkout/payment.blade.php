<!-- resources/views/user/checkout/payment.blade.php -->
@extends('layouts.user_without_sidebar')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-3xl font-bold mb-6">Payment</h2>
    <div class="bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('checkout.complete') }}" method="POST" class="space-y-4">
            @csrf
            <h3 class="text-xl font-semibold mb-4">Select Payment Method</h3>
            <div class="space-y-4">
                <div>
                    <input type="radio" id="card_payment" name="payment_method" value="card" onclick="togglePaymentMethod()" checked>
                    <label for="card_payment">Card Payment</label>
                </div>
                <div>
                    <input type="radio" id="pay_on_delivery" name="payment_method" value="delivery" onclick="togglePaymentMethod()">
                    <label for="pay_on_delivery">Pay on Delivery</label>
                </div>
            </div>
            <div id="card_details" class="space-y-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="card_number">Card Number</label>
                    <input type="text" id="card_number" name="card_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="expiry_date">Expiry Date</label>
                        <input type="text" id="expiry_date" name="expiry_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
            </div>
            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Complete Payment</button>
        </form>
    </div>
</div>
<script>
    function togglePaymentMethod() {
        const cardPayment = document.getElementById('card_payment').checked;
        const cardDetails = document.getElementById('card_details');
        if (cardPayment) {
            cardDetails.style.display = 'block';
        } else {
            cardDetails.style.display = 'none';
        }
    }
    document.addEventListener('DOMContentLoaded', togglePaymentMethod);
</script>
@endsection
