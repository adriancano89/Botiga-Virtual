<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos_producto')->insert([
            [
                'categoria_id' => 1,
                'codigo' => 'PROD001',
                'foto' => '',
                'nombre' => 'Sudadera urban básica',
                'precio' => 39.99,
                'destacado' => true,
                'descripcion' => 'Sudadera estilo urbano con capucha para hombre.',
                'estado' => true,
            ],
            [
                'categoria_id' => 2,
                'codigo' => 'PROD002',
                'foto' => '',
                'nombre' => 'Sudadera deportiva sin capucha',
                'precio' => 29.99,
                'destacado' => false,
                'descripcion' => 'Sudadera deportiva sin capucha para mujer.',
                'estado' => true,
            ],
            [
                'categoria_id' => 3,
                'codigo' => 'PROD003',
                'foto' => '',
                'nombre' => 'Sudadera básica con capucha',
                'precio' => 19.99,
                'destacado' => true,
                'descripcion' => 'Sudadera básica con capucha para niños.',
                'estado' => false,
            ],
            [
                'categoria_id' => 4,
                'codigo' => 'PROD004',
                'foto' => '',
                'nombre' => 'Sudadera casual sin capucha',
                'precio' => 34.99,
                'destacado' => false,
                'descripcion' => 'Sudadera casual sin capucha para hombre.',
                'estado' => false,
            ],
            [
                'categoria_id' => 5,
                'codigo' => 'PROD005',
                'foto' => '',
                'nombre' => 'Sudadera deportiva con capucha',
                'precio' => 39.99,
                'destacado' => true,
                'descripcion' => 'Sudadera deportiva con capucha para mujer.',
                'estado' => true,
            ],
            [
                'categoria_id' => 6,
                'codigo' => 'PROD006',
                'foto' => '',
                'nombre' => 'Sudadera estampada sin capucha',
                'precio' => 32.99,
                'destacado' => false,
                'descripcion' => 'Sudadera estampada sin capucha para mujer.',
                'estado' => true,
            ],
            [
                'categoria_id' => 7,
                'codigo' => 'PROD007',
                'foto' => '',
                'nombre' => 'Sudadera básica con capucha',
                'precio' => 27.99,
                'destacado' => true,
                'descripcion' => 'Sudadera básica con capucha para mujer.',
                'estado' => false,
            ],
            [
                'categoria_id' => 8,
                'codigo' => 'PROD008',
                'foto' => '',
                'nombre' => 'Sudadera urban sin capucha',
                'precio' => 24.99,
                'destacado' => false,
                'descripcion' => 'Sudadera urbana sin capucha para niño.',
                'estado' => true,
            ]
        ]);
    }
}
