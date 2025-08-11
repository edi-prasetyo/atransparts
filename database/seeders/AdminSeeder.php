<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $userId = DB::table('users')->insertGetId([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '1234567890',
            'email_verified_at' => Carbon::now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $role = DB::table('roles')->where('name', 'superadmin')->first();

        DB::table('role_users')->insert([
            'user_id' => $userId,
            'role_id' => $role->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
