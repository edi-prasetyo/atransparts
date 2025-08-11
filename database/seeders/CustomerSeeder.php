<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            [
                'full_name' => 'Andre Suarta',
                'phone' => '081234567891',
                'address' => 'Jl. kemanggisan No. 1, Tangerang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'John Doe',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 1, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Jane Smith',
                'phone' => '082345678901',
                'address' => 'Jl. Sudirman No. 2, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Budi Santoso',
                'phone' => '083456789012',
                'address' => 'Jl. Malioboro No. 3, Yogyakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('customers')->insert($customers);
    }
}
