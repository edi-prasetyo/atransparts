<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Post extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $table = ('posts');
    protected $fillable = [];

    public function incrementReadCount()
    {
        $this->views++;
        return $this->save();
    }
    public function postTranslations()
    {
        return $this->hasMany(PostTranslation::class);
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
