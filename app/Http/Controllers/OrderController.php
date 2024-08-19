<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CustomerOrderNotification;
use App\Notifications\AdminOrderNotification;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        Log::info('Fetching orders list');
        $filter = $request->get('filter', 'all');

        if ($filter == 'deleted') {
            $orders = Order::onlyTrashed()->with('user')->get();
        } else {
            $orders = Order::with('user')->get();
        }

        Log::info('Orders fetched', ['count' => $orders->count(), 'filter' => $filter]);
        return view('admin.orders.index', compact('orders', 'filter'));
    }

    public function destroy($id)
    {
        Log::info('Attempting to delete order', ['order_id' => $id]);
        $order = Order::findOrFail($id);
        $order->delete();
        Log::info('Order deleted successfully', ['order_id' => $id]);
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }

    public function restore($id)
    {
        Log::info('Attempting to restore order', ['order_id' => $id]);
        $order = Order::withTrashed()->findOrFail($id);
        $order->restore();
        Log::info('Order restored successfully', ['order_id' => $id]);
        return redirect()->route('admin.orders.index')->with('success', 'Order restored successfully.');
    }

    public function forceDelete($id)
    {
        Log::info('Attempting to permanently delete order', ['order_id' => $id]);
        $order = Order::withTrashed()->findOrFail($id);
        $order->forceDelete();
        Log::info('Order permanently deleted', ['order_id' => $id]);
        return redirect()->route('admin.orders.index')->with('success', 'Order permanently deleted.');
    }

    public function show($id)
    {
        Log::info('Fetching order details', ['order_id' => $id]);
        $order = Order::find($id);
        if (!$order) {
            Log::warning('Order not found', ['order_id' => $id]);
            return redirect()->route('admin.orders.index')->with('error', 'Order not found.');
        }
        Log::info('Order details fetched successfully', ['order_id' => $id]);
        return view('admin.orders.show', compact('order'));
    }

    public function placeOrder()
    {
        Log::info('Start placeOrder process');

        $cart = Session::get('cart', []);
        Log::info('Cart Contents:', $cart);

        if (empty($cart)) {
            Log::error('Attempt to place order with empty cart');
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        Log::info('Cart is not empty, proceeding with order creation');

        try {
            $order = new Order();
            $order->user_id = Auth::id();

            // Calculate total price
            $total = 0;
            foreach ($cart as $id => $details) {
                $total += $details['price'] * $details['quantity'];
            }

            $order->total = $total;
            $order->save();

            Log::info('Order created', ['order_id' => $order->id, 'total' => $total]);

            foreach ($cart as $id => $details) {
                $product = Product::find($id);
                if (!$product) {
                    Log::error('Product not found during order placement', ['product_id' => $id]);
                    throw new \Exception("Product with ID {$id} not found.");
                }

                $orderItem = new OrderItem([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price']
                ]);
                $orderItem->save();

                Log::info('OrderItem created', ['order_id' => $order->id, 'product_id' => $id]);
            }

            try {
                $customer = Auth::user();
                Log::info('Attempting to send customer notification', ['customer_email' => $customer->email]);
                Notification::send($customer, new CustomerOrderNotification($order));
                Log::info('Customer notification sent successfully');
            } catch (\Exception $e) {
                Log::error('Failed to send customer notification', [
                    'error' => $e->getMessage(),
                    'stack_trace' => $e->getTraceAsString()
                ]);
            }

            // Send notification to admin
            try {
                $admin = User::role('admin')->first();
                if ($admin) {
                    Log::info('Attempting to send admin notification', ['admin_email' => $admin->email]);
                    Notification::send($admin, new AdminOrderNotification($order));
                    Log::info('Admin notification sent successfully');
                } else {
                    Log::warning('No admin user found to send order notification');
                }
            } catch (\Exception $e) {
                Log::error('Failed to send admin notification', [
                    'error' => $e->getMessage(),
                    'stack_trace' => $e->getTraceAsString()
                ]);
            }

            Session::forget('cart');
            Log::info('Order placed successfully, cart cleared', ['order_id' => $order->id]);

            return redirect()->route('user.dashboard')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            Log::error('Error during order placement', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('cart.view')->with('error', 'An error occurred while placing your order. Please try again.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        Log::info('Attempting to update order status', ['order_id' => $id, 'new_status' => $request->status]);
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        Log::info('Order status updated successfully', ['order_id' => $id, 'new_status' => $request->status]);
        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }
}