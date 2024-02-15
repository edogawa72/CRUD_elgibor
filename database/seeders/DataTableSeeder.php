<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Data;

class DataTableSeeder extends Seeder
{


    public function run(): void
    {
        $data = [
            [
                'nik' => '3315042011990001',
                'nama' => 'Kurnia Edo Susandro', 
                'telp' => '0895392305379',
                'alamat' => 'Jalan Karya Bakti 07/04 Krangganharjo, Toroh, Grobogan',
                'kota' => 'Purwodadi',
                'latitude' => '-6.2088',
                'longitude' => '106.8456',
            ],
        ];

        foreach ($data as $data) {
            Data::create($data);
        }

    }
}
