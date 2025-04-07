<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'apellidos' => '',
                'password' => Hash::make('123'),
                'email' => 'admin@gmail.com',
                'telefono' => '638743492',
                'direccion' => 'Carrer Europa 3r 2n, Barcelona',
                'rol' => true
            ],
            [
                'name' => 'Pablo',
                'apellidos' => 'García Fernández',
                'password' => Hash::make('123'),
                'email' => 'pablo@gmail.com',
                'telefono' => '628543546',
                'direccion' => 'Carrer Montserrat 30 2n 1r, Tarragona',
                'rol' => true
            ],
            [
                'name' => 'Marta',
                'apellidos' => 'López Sánchez',
                'password' => Hash::make('123'),
                'email' => 'marta@gmail.com',
                'telefono' => '645848549',
                'direccion' => 'Carrer Àngel Guimerà 30 4t 1r, Girona',
                'rol' => true
            ],
            [
                'name' => 'Juan',
                'apellidos' => 'Martínez Pérez',
                'password' => Hash::make('123'),
                'email' => 'juan@gmail.com',
                'telefono' => '634897512',
                'direccion' => 'Calle Mayor 15 3º 1a, Madrid',
                'rol' => false
            ],
            [
                'name' => 'Montse',
                'apellidos' => 'Hernández Ruiz',
                'password' => Hash::make('123'),
                'email' => 'montse@gmail.com',
                'telefono' => '629458371',
                'direccion' => 'Avenida de la Libertad 32 2º 1a, Valencia',
                'rol' => false
            ]
        ]);
    }
}
