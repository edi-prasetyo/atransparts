<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'shop_id',
        'payment_method',
        'payment_status',
        'status',
        'total_price',
        'discount',
        'grand_total',
        'shipping_address',
        'tracking_number',
        'shipped_at',
        'delivered_at',
        'canceled_at',
        'note',
        'quantity',
        'order_number',
        'invoice_number',
        'shipping_cost',
        'tax',
        'discount',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
