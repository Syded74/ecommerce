<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
    public function viewCart()
    {
        $cart = Session::get('cart', []);
        return view('cart.view', compact('cart'));
    }

    public function addToCart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('cart.view')->with('error', 'Product not found.');
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Product added to cart.');
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Product removed from cart.');
    }
}
