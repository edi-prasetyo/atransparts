<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['full_name', 'phone', 'address', 'shop_id'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
