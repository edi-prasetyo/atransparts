<?php

namespace App\Models;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'production_id',
        'slug',
        'views',
        'trending',
        'status'
    ];
    public function productTranslations()
    {
        return $this->hasMany(ProductTranslation::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    public function incrementReadCount()
    {
        $this->views++;
        return $this->save();
    }
}
