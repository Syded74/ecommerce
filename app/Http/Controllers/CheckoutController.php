<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function show()
    {
        $cartItems = Cart::getContent();
        $cartTotal = Cart::getTotal();

        return view('user.checkout.checkout', compact('cartItems', 'cartTotal'));
    }

    public function process(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'shipping_address' => 'required|string|max:255',
            'billing_address' => 'required|string|max:255',
            'vat_number' => 'nullable|string|max:255',
        ]);

        // Save order details to the session
        session(['checkout' => $validated]);

        return redirect()->route('checkout.payment');
    }

    public function payment()
    {
        $cartItems = Cart::getContent();
        $cartTotal = Cart::getTotal();
        $checkoutDetails = session('checkout');

        return view('user.checkout.payment', compact('cartItems', 'cartTotal', 'checkoutDetails'));
    }

    public function complete(Request $request)
    {
        // Validate the payment method
        $validated = $request->validate([
            'payment_method' => 'required|in:card,delivery',
        ]);
    
        // If card payment is selected, validate card details
        if ($validated['payment_method'] == 'card') {
            $request->validate([
                'card_number' => 'required|string|max:16',
                'expiry_date' => 'required|string|max:5',
                'cvv' => 'required|string|max:3',
            ]);
        }
    
        $checkoutDetails = session('checkout');
        $checkoutDetails['user_id'] = Auth::id();
        $checkoutDetails['total'] = Cart::getTotal();
        $checkoutDetails['subtotal'] = $checkoutDetails['total'];
        $checkoutDetails['tax'] = 0; // Add this line to set tax, adjust the value as needed
        $checkoutDetails['status'] = 'pending';
        $checkoutDetails['payment_method'] = $validated['payment_method'];
    
        // Create an order
        $order = Order::create($checkoutDetails);
    
        // Save order items
        foreach (Cart::getContent() as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }
    
        // Clear the cart
        Cart::clear();
    
        // Clear the session
        session()->forget('checkout');
    
        // Redirect to the success page
        return redirect()->route('checkout.success')->with('success', 'Order placed successfully.');
    }
    
    public function success()
    {
        return view('user.checkout.success');
    }
} 