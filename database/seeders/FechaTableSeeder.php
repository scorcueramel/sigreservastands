<?php

namespace Database\Seeders;

use App\Models\Fecha;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FechaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Fecha::create([
            "descripcion"=> "FECHA 1",
            "estado"=> "A",
        ]);
        Fecha::create([
            "descripcion"=> "FECHA 2",
            "estado"=> "A",
        ]);
        Fecha::create([
            "descripcion"=> "FECHA 3",
            "estado"=> "A",
        ]);
        Fecha::create([
            "descripcion"=> "FECHA 4",
            "estado"=> "A",
        ]);
    }
}
