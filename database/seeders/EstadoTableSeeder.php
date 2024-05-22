<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Estado::create([
            'descripcion'=>'ACTIVO',
        ]);
        Estado::create([
            'descripcion'=>'INACTIVO',
        ]);
        Estado::create([
            'descripcion'=>'LIBRE',
        ]);
        Estado::create([
            'descripcion'=>'RESERVADO',
        ]);
        Estado::create([
            'descripcion'=>'ASIGNADO',
        ]);

    }
}
