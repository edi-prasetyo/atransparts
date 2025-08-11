<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class About extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $table = ('abouts');

    protected $fillable = [
        'slug',
        'image',
    ];



    public function aboutTranslations()
    {
        return $this->hasMany(AboutTranslation::class);
    }

    public function getTitleAttribute()
    {
        return $this->getTranslatedField('title');
    }

    public function getContentAttribute()
    {
        return $this->getTranslatedField('content');
    }
}
