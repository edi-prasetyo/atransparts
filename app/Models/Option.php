<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = ('options');

    protected $fillable = [
        'title',
        'tagline',
        'description',
        'keywords',
        'google_meta',
        'bing_meta',
        'google_analytics',
        'google_tag',
        'logo',
        'second_logo',
        'favicon',
        'email',
        'phone',
        'whatsapp',
        'address',
        'link',
        'facebook',
        'instagram',
        'tiktok',
        'twitter',
        'maps',
    ];
}
