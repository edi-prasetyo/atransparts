<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Production;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        $productions = [
            ['name' => 'Jepang', 'country' => 'Jepang'],
            ['name' => 'China',  'country' => 'China'],
        ];

        foreach ($productions as $data) {
            Production::firstOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'name' => $data['name'],
                    'country' => $data['country'],
                    'image' => null,
                    'status' => 1,
                ]
            );
        }
    }
}
