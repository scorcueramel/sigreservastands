<?php

namespace Database\Seeders;

use App\Models\Dia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Dia::create([
            'descripcion'=>'SÁBADO',
            'estado'=>'A',
        ]);
        Dia::create([
            'descripcion'=>'DOMINGO',
            'estado'=>'A',
        ]);
        Dia::create([
            'descripcion'=>'SÁBADO Y DOMINGO',
            'estado'=>'A',
        ]);
    }
}
