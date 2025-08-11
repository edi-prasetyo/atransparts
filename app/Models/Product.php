<?php

namespace App\Models;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Product extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'products';

    protected $fillable = [
        'production_id',
        'slug',
        'name',
        'product_brand_id',
        'views',
        'trending',
        'status'
    ];

    // Translation methods
    public function productTranslations()
    {
        return $this->hasMany(ProductTranslation::class);
    }
    public function getNameAttribute()
    {
        return $this->getTranslatedField('name');
    }

    public function getDescriptionAttribute()
    {
        return $this->getTranslatedField('description');
    }

    public function getMetaTitleAttribute()
    {
        return $this->getTranslatedField('meta_title');
    }

    public function getMetaDescriptionAttribute()
    {
        return $this->getTranslatedField('meta_description');
    }

    // Translation methods

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
    public function productNumbers()
    {
        return $this->hasMany(ProductNumber::class);
    }
}
