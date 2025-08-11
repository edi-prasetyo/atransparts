<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $role = DB::table('roles')->where('name', 'superadmin')->first();
        $permissions = DB::table('permissions')->get();

        foreach ($permissions as $permission) {
            DB::table('role_permissions')->insert([
                'role_id' => $role->id,
                'permission_id' => $permission->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
