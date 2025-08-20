<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductNumber extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'number',
        'vendor_number',
        'model_number',
        'buy_price',
        'sell_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function stock()
    {
        return $this->hasOne(Stock::class); // misalnya
    }
    public function productBrand()
    {
        return $this->belongsTo(ProductBrand::class);
    }
}
