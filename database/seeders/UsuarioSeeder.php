<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'nombre' => 'admin',
                'apellidos' => '',
                'contrasena' => Hash::make('123'),
                'email' => 'admin@gmail.com',
                'telefono' => '638743492',
                'direcion' => 'Carrer Europa 3r 2n, Barcelona',
                'rol' => true
            ],
            [
                'nombre' => 'Pablo',
                'apellidos' => 'García Fernández',
                'contrasena' => Hash::make('123'),
                'email' => 'pablo@gmail.com',
                'telefono' => '628543546',
                'direcion' => 'Carrer Montserrat 30 2n 1r, Tarragona',
                'rol' => true
            ],
            [
                'nombre' => 'Marta',
                'apellidos' => 'López Sánchez',
                'contrasena' => Hash::make('123'),
                'email' => 'marta@gmail.com',
                'telefono' => '645848549',
                'direcion' => 'Carrer Àngel Guimerà 30 4t 1r, Girona',
                'rol' => true
            ],
            [
                'nombre' => 'Juan',
                'apellidos' => 'Martínez Pérez',
                'contrasena' => Hash::make('123'),
                'email' => 'juan@gmail.com',
                'telefono' => '634897512',
                'direcion' => 'Calle Mayor 15 3º 1a, Madrid',
                'rol' => false
            ],
            [
                'nombre' => 'Montse',
                'apellidos' => 'Hernández Ruiz',
                'contrasena' => Hash::make('123'),
                'email' => 'montse@gmail.com',
                'telefono' => '629458371',
                'direcion' => 'Avenida de la Libertad 32 2º 1a, Valencia',
                'rol' => false
            ]
        ]);
    }
}
