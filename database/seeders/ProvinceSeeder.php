<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = [
            'Aceh',
            'Sumatera Utara',
            'Sumatera Barat',
            'Riau',
            'Kepulauan Riau',
            'Jambi',
            'Bengkulu',
            'Sumatera Selatan',
            'Bangka Belitung',
            'Lampung',
            'DKI Jakarta',
            'Jawa Barat',
            'Banten',
            'Jawa Tengah',
            'DI Yogyakarta',
            'Jawa Timur',
            'Bali',
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Kalimantan Barat',
            'Kalimantan Tengah',
            'Kalimantan Selatan',
            'Kalimantan Timur',
            'Kalimantan Utara',
            'Sulawesi Utara',
            'Sulawesi Tengah',
            'Sulawesi Selatan',
            'Sulawesi Tenggara',
            'Gorontalo',
            'Sulawesi Barat',
            'Maluku',
            'Maluku Utara',
            'Papua',
            'Papua Barat',
            'Papua Tengah',
            'Papua Pegunungan',
            'Papua Selatan',
            'Papua Barat Daya',
        ];

        foreach ($provinces as $name) {
            Province::firstOrCreate(['name' => $name]);
        }
    }
}
