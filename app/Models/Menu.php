<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = ('menus');

    protected $fillable = [
        'slug',
        'position',
        'link',
        'parent_id',
        'status',

    ];

    public function menuTranslations()
    {
        return $this->hasMany(MenuTranslation::class);
    }
}
