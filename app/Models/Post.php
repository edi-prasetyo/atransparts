<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
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
}
