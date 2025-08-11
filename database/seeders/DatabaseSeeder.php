<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MenuAdminSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            AdminSeeder::class,
            ProductionSeeder::class,
            ProvinceSeeder::class,
            CustomerSeeder::class,
            BrandVehicleSeeder::class,
        ]);
    }
}
