<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show()
    {
        return view('user.checkout.checkout'); // Ensure this path matches your Blade template path
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

        // Process the order (e.g., save to the database, send email, etc.)
        // ...

        return redirect()->route('order.success'); // Or wherever you want to redirect
    }
}
