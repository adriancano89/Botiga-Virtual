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
                'nombre' => 'Negro'
            ],
            [
                'nombre' => 'Blanco'
            ],
            [
                'nombre' => 'Azul marino'
            ],
            [
                'nombre' => 'Azul cielo'
            ],
            [
                'nombre' => 'Rojo'
            ],
            [
                'nombre' => 'Naranja'
            ],
            [
                'nombre' => 'Amarillo'
            ],
            [
                'nombre' => 'Rosa'
            ],
            [
                'nombre' => 'Morado'
            ]
        ]);
    }
}
