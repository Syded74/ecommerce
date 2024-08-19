<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class AdminOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Order Placed')
            ->line('A new order has been placed.')
            ->line('Order ID: ' . $this->order->id)
            ->line('Customer: ' . $this->order->user->name)
            ->line('Customer Email: ' . $this->order->user->email)
            ->line('Total Amount: $' . number_format($this->order->total_amount, 2))
            ->action('View Order Details', url('/admin/orders/' . $this->order->id))
            ->line('Please process this order as soon as possible.');
    }
}