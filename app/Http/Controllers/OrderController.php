<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        if ($filter == 'deleted') {
            $orders = Order::onlyTrashed()->get();
        } else {
            $orders = Order::all();
        }

        return view('admin.orders.index', compact('orders', 'filter'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }

    public function restore($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $order->restore();

        return redirect()->route('admin.orders.index')->with('success', 'Order restored successfully.');
    }

    public function forceDelete($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $order->forceDelete();

        return redirect()->route('admin.orders.index')->with('success', 'Order permanently deleted.');
    }

    public function show($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', 'Order not found.');
        }
        return view('admin.orders.show', compact('order'));
    }

    public function placeOrder()
    {
        Log::info('Start placeOrder');

        $cart = Session::get('cart', []);

        Log::info('Cart Contents:', $cart);

        if (empty($cart)) {
            Log::error('Cart is empty');
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        Log::info('Cart is not empty');

        $order = new Order();
        $order->user_id = Auth::id();

        // Calculate total price
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        $order->total = $total;
        $order->save();

        Log::info('Order saved: ' . $order->id);

        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if (!$product) {
                Log::error('Product with ID ' . $id . ' not found.');
                return redirect()->route('cart.view')->with('error', 'Product with ID ' . $id . ' not found.');
            }

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $id;
            $orderItem->quantity = $details['quantity'];
            $orderItem->price = $details['price'];
            $orderItem->save();

            Log::info('OrderItem saved for product ID ' . $id);
        }

        Session::forget('cart');

        Log::info('Order placed successfully');
        return redirect()->route('user.dashboard')->with('success', 'Order placed successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }
}
