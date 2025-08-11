<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
    public function menuPermissions()
    {
        return $this->belongsToMany(MenuAdmin::class, 'menu_permissions');
    }
    public function menus()
    {
        return $this->belongsToMany(MenuAdmin::class, 'menu_permissions', 'role_id', 'menu_admin_id')
            ->withTimestamps();
    }
}
