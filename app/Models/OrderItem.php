<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Add the fillable property to allow mass assignment
    protected $fillable = [
        'order_id', // Add this line
        'product_id', // Add this if you're also mass assigning product_id
        'quantity',  // Add this if you're also mass assigning quantity
        'price',     // Add this if you're also mass assigning price
    ];

    // Define the relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
