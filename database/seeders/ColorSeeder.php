<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colores')->insert([
            [
                'nombre' => 'Negro',
                'hexadecimal' => '#000000'
            ],
            [
                'nombre' => 'Blanco',
                'hexadecimal' => '#FFFFFF'
            ],
            [
                'nombre' => 'Azul marino',
                'hexadecimal' => '#000080'
            ],
            [
                'nombre' => 'Azul cielo',
                'hexadecimal' => '#00FFFF'
            ],
            [
                'nombre' => 'Rojo',
                'hexadecimal' => '#FF0000'
            ],
            [
                'nombre' => 'Naranja',
                'hexadecimal' => '#FFA500'
            ],
            [
                'nombre' => 'Amarillo',
                'hexadecimal' => '#FFFF00'
            ],
            [
                'nombre' => 'Rosa',
                'hexadecimal' => '#FF00FF'
            ],
            [
                'nombre' => 'Morado',
                'hexadecimal' => '#800080'
            ]
        ]);
    }
}
