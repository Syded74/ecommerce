<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show()
    {
        return view('user.checkout.checkout');
    }

    public function process(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'shipping_address' => 'required|string|max:255',
            'billing_address' => 'required|string|max:255',
        ]);

        // Save order details to the session or database
        session(['checkout' => $validated]);

        return redirect()->route('checkout.payment');
    }

    public function payment()
    {
        return view('user.checkout.payment');
    }

    public function complete(Request $request)
    {
        // Validate the payment details
        $request->validate([
            'payment_method' => 'required|string',
            'card_number' => 'required_if:payment_method,card|string|max:16',
            'expiry_date' => 'required_if:payment_method,card|string|max:5',
            'cvv' => 'required_if:payment_method,card|string|max:3',
            'billing_address' => 'required|string|max:255',
        ]);

        $checkoutDetails = session('checkout');
        $checkoutDetails['user_id'] = Auth::id();
        $checkoutDetails['total'] = 200; // Update this with the actual total
        $checkoutDetails['status'] = 'pending';

        // Create an order
        $order = Order::create($checkoutDetails);

        // Clear the session
        session()->forget('checkout');

        return redirect()->route('user.dashboard')->with('success', 'Order placed successfully.');
    }
}
