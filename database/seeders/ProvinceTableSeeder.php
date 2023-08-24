<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $provinces = array_unique([
            'Bocas del Toro',
            'Cocle',
            'Colon',
            'Chiriqui',
            'Darien',
            'Herrera',
            'Los Santos',
            'Panama',
            'Veraguas',
            'Comarca Kuna Yala',
            'Comarca Embera-Wounaan',
            'Comarca Ngäbe-Buglé',
            'Panama Oeste',
        ]);

        foreach ($provinces as $province) {
            \App\Models\Province::create( [
                'name' => $province
            ]);
        }
        
        
    }
}
