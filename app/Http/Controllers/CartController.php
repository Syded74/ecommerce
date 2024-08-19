<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Ensure this import is present

class CartController extends Controller
{
    public function viewCart()
    {
        $cartItems = Cart::getContent();
        return view('user.cart.view', compact('cartItems'));
    }

    public function addToCart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('cart.view')->with('error', 'Product not found.');
        }

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $product->image
            ]
        ]);

        return redirect()->route('cart.view')->with('success', 'Product added to cart.');
    }

    public function removeFromCart($id)
    {
        Cart::remove($id);
        return redirect()->route('cart.view')->with('success', 'Product removed from cart.');
    }

    public function checkout()
    {
        $cartItems = Cart::getContent();
        $subtotal = Cart::getSubTotal();
        $this->addTaxCondition();
        $taxCondition = Cart::getCondition('tax');
        $tax = $taxCondition ? $taxCondition->getCalculatedValue($subtotal) : 0;
        $total = $subtotal + $tax;

        return view('user.checkout.checkout', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    public function addTaxCondition()
    {
        $condition = new CartCondition([
            'name' => 'tax',
            'type' => 'tax',
            'target' => 'subtotal',
            'value' => '10%', // Adjust the tax rate as needed
        ]);

        Cart::condition($condition);
    }

    public function completeCheckout(Request $request)
    {
        Log::info('Complete Checkout Started');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'vat_number' => 'nullable|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:card_payment,pay_on_delivery',
            'card_number' => 'nullable|string|max:16',
            'expiry_date' => 'nullable|string|max:5',
            'cvv' => 'nullable|string|max:3',
        ]);

        Log::info('Validation Passed');

        $cartItems = Cart::getContent();
        $subtotal = Cart::getSubTotal();
        $this->addTaxCondition();
        $taxCondition = Cart::getCondition('tax');
        $tax = $taxCondition ? $taxCondition->getCalculatedValue($subtotal) : 0;
        $total = $subtotal + $tax;

        Log::info('Cart Items and totals calculated');

        $order = new Order();
        $order->user_id = Auth::id();
        $order->payment_method = $request->payment_method;
        $order->card_number = $request->card_number;
        $order->expiry_date = $request->expiry_date;
        $order->cvv = $request->cvv;
        $order->shipping_address = $request->shipping_address;
        $order->subtotal = $subtotal;
        $order->tax = $tax;
        $order->total = $total;
        $order->save();

        Log::info('Order saved');

        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->price;
            $orderItem->save();
        }

        Log::info('Order items saved');

        Cart::clear();

        Log::info('Cart cleared');

        return redirect()->route('checkout.success');
    }

    public function checkoutSuccess()
    {
        return view('user.checkout.success');
    }
}
