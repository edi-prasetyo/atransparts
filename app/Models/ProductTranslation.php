<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'locale',
        'name',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];
}
