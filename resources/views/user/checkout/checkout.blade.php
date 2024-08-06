@extends('layouts.user_without_sidebar')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-3xl font-bold mb-6">Checkout</h2>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="shipping_address">Shipping Address:</label>
            <input type="text" id="shipping_address" name="shipping_address" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="checkbox" id="same_as_shipping" name="same_as_shipping" onclick="copyAddress()">
            <label for="same_as_shipping">Billing address same as shipping</label>
        </div>
        <div class="form-group">
            <label for="billing_address">Billing Address:</label>
            <input type="text" id="billing_address" name="billing_address" class="form-control" required>
        </div>
        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition duration-300">Place Order</button>
    </form>
</div>

<script>
    function copyAddress() {
        if (document.getElementById('same_as_shipping').checked) {
            document.getElementById('billing_address').value = document.getElementById('shipping_address').value;
        } else {
            document.getElementById('billing_address').value = '';
        }
    }
</script>
@endsection
