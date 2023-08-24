<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $districts = [
            'BOCAS DEL TORO',
            'CHANGUINOLA',
            'CHIRIQUI GRANDE',
            'AGUADULCE',
            'ANTON',
            'LA PINTADA',
            'NATA',
            'OLA',
            'PENONOME',
            'COLON',
            'CHAGRES',
            'DONOSO',
            'PORTOBELO',
            'SANTA ISABEL',
            'ALANJE',
            'BARU',
            'BOQUERON',
            'BOQUETE',
            'BUGABA',
            'DAVID',
            'DOLEGA',
            'GUALACA',
            'REMEDIOS',
            'RENACIMIENTO',
            'SAN FELIX',
            'SAN LORENZO',
            'TOLE',
            'CHEPIGANA',
            'PINOGANA',
            'CHITRE',
            'LAS MINAS',
            'LOS POZOS',
            'OCU',
            'PARITA',
            'PESE',
            'SANTA MARIA',
            'GUARARE',
            'LAS TABLAS',
            'LOS SANTOS',
            'MACARACAS',
            'PEDASI',
            'POCRI',
            'TONOSI',
            'BALBOA',
            'CHEPO',
            'CHIMAN',
            'PANAMA',
            'SAN MIGUELITO',
            'TABOGA',
            'ATALAYA',
            'CALOBRE',
            'CAÑAZAS',
            'LA MEZA',
            'LAS PALMAS',
            'MONTIJO',
            'RIO DE JESUS',
            'SAN FRANCISCO',
            'SANTA FE',
            'SANTIAGO',
            'SONA',
            'MARIATO',
            'COMARCA KUNA YALA',
            'CEMACO',
            'SAMBU',
            'BESIKO',
            'MIRONO',
            'MUNA',
            'NOLE DUIMA',
            'NURUM',
            'KANKINTU',
            'KUSAPIN',
            'ARRAIJAN',
            'CAPIRA',
            'CHAME',
            'LA CHORRERA',
            'SAN CARLOS',
        ];

        foreach ($districts as $district) {
            \App\Models\District::create( [
                'name' => $district
            ]);
        }
        
    }
}
