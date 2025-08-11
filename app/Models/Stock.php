<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'product_id',
        'product_number_id',
        'quantity',
    ];

    public function productNumber()
    {
        return $this->belongsTo(ProductNumber::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
