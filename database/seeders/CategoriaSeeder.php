<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            [
                'codigo' => 'H7524',
                'nombre' => 'Urban | Capucha | Hombre'
            ],
            [
                'codigo' => 'M3817',
                'nombre' => 'Deportiva | Sin Capucha | Mujer'
            ],
            [
                'codigo' => 'N9462',
                'nombre' => 'Básica | Capucha | Niño'
            ],
            [
                'codigo' => 'H5638',
                'nombre' => 'Estilo Casual | Sin Capucha | Hombre'
            ],
            [
                'codigo' => 'M2145',
                'nombre' => 'Deportiva | Capucha | Mujer'
            ],
            [
                'codigo' => 'M6527',
                'nombre' => 'Estampada | Sin Capucha | Mujer'
            ],
            [
                'codigo' => 'M3098',
                'nombre' => 'Básica | Capucha | Mujer'
            ],
            [
                'codigo' => 'N4812',
                'nombre' => 'Urban | Sin Capucha | Niño'
            ]
        ]);
    }
}
