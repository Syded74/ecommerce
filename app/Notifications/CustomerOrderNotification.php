<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class CustomerOrderNotification extends Notification
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
            ->subject('Your Order Has Been Placed')
            ->greeting('Hello ' . $this->order->user->name . ',')
            ->line('Thank you for your order!')
            ->line('Order ID: ' . $this->order->id)
            ->line('Total Amount: $' . number_format($this->order->total_amount, 2))
            ->action('View Order Details', url('/orders/' . $this->order->id))
            ->line('We appreciate your business!');
    }
}