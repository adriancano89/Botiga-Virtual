<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TallaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tallas')->insert([
            [
                'nombre' => 'XXS'
            ],
            [
                'nombre' => 'XS'
            ],
            [
                'nombre' => 'S'
            ],
            [
                'nombre' => 'M'
            ],
            [
                'nombre' => 'L'
            ],
            [
                'nombre' => 'XL'
            ],
            [
                'nombre' => 'XXL'
            ],
            [
                'nombre' => 'XXXL'
            ]
        ]);
    }
}
