<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'user_id',
        'product_id',
        'product_number_id',
        'stock_id',
        'date_created',
        'type',
        'quantity',
        'order_id',
        'note',
    ];

    protected $dates = ['date_created'];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productNumber()
    {
        return $this->belongsTo(ProductNumber::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
