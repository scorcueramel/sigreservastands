<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TipoDocumento::create([
            'descripcion' => 'DOCUMENTO NACIONAL DE IDENTIDAD',
            'abreviatura' => 'DNI',
            'estado' => 'A',
        ]);
        TipoDocumento::create([
            'descripcion' => 'REGISTRO UNICO DE CONTRIBUYENTE',
            'abreviatura' => 'RUC',
            'estado' => 'A',
        ]);
        TipoDocumento::create([
            'descripcion' => 'CARNET DE EXTRANJERIA',
            'abreviatura' => 'CE',
            'estado' => 'A',
        ]);
    }
}
