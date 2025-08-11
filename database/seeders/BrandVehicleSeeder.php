<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandVehicleSeeder extends Seeder
{
    public function run(): void
    {
        $brandData = [
            'Toyota' => ['Avanza', 'Innova', 'Hiace'],
            'Daihatsu' => ['Xenia', 'Ayla', 'Gran Max'],
            'Mitsubishi' => ['Xpander', 'Outlander'],
            'Suzuki' => [],
            'Honda' => [],
        ];

        foreach ($brandData as $brand => $vehicles) {
            $brandId = DB::table('brands')->insertGetId([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'image' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($vehicles as $vehicle) {
                DB::table('vehicles')->insert([
                    'name' => $vehicle,
                    'brand_id' => $brandId,
                    'slug' => Str::slug($vehicle),
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
