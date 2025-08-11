<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Traits\HasTranslations;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = ('categories');

    protected $fillable = [
        'slug',
        'image',
        'status',

    ];

    public function categoryTranslations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }
    public function getNameAttribute()
    {
        return $this->getTranslatedField('name');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
