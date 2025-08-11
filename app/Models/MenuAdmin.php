<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAdmin extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'route_name', 'icon', 'group', 'parent_id', 'order'];



    public function children()
    {
        return $this->hasMany(MenuAdmin::class, 'parent_id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(MenuAdmin::class, 'parent_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_permissions', 'menu_admin_id', 'role_id')
            ->withTimestamps();
    }
}
