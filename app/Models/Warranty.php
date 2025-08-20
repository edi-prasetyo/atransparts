<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_number_id',
        'code',
        'qr_image',
        'warranty_code',
        'customer_name',
        'phone',
        'nopol',
        'km',
        'active_until',
        'status',
        'claim',
        'claim_status',
        'note',
        'claim_date'
    ];

    // Kalau mau pakai format tanggal otomatis
    protected $dates = [
        'active_until',
        'claim_date',
        'created_at',
        'updated_at',
    ];

    public function productNumber()
    {
        return $this->belongsTo(ProductNumber::class);
    }
}
