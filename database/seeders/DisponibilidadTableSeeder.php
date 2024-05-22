<?php

namespace Database\Seeders;

use App\Models\Disponibilidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisponibilidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $fechas = [
            "fecha1" => 1,
            "fecha2" => 2,
            "fecha3" => 3,
            "fecha4" => 4,
        ];
        $dias = [
            "dia1" => 1,
            "dia2" => 2,
            "dia3" => 3,
        ];
        $stands = [
            "stand1" => 1,
            "stand2" => 2,
            "stand3" => 3,
            "stand4" => 4,
            "stand5" => 5,
            "stand6" => 6,
            "stand7" => 7,
            "stand8" => 8,
            "stand9" => 9,
            "stand10" => 10,
            "stand11" => 11,
            "stand12" => 12,
            "stand13" => 13,
            "stand14" => 14,
            "stand15" => 15,
            "stand16" => 16,
            "stand17" => 17,
            "stand18" => 18,
            "stand19" => 19,
            "stand20" => 20,
            "stand21" => 21,
            "stand22" => 22,
            "stand23" => 23,
            "stand24" => 24,
            "stand25" => 25,
            "stand26" => 26,
            "stand27" => 27,
            "stand28" => 28,
            "stand29" => 29,
            "stand30" => 30,
            "stand31" => 31,
            "stand32" => 32,
            "stand33" => 33,
            "stand34" => 34,
            "stand35" => 35,
            "stand36" => 36,
            "stand37" => 37,
            "stand38" => 38,
            "stand39" => 39,
            "stand40" => 40,
            "stand41" => 41,
            "stand42" => 42,
            "stand43" => 43,
            "stand44" => 44,
            "stand45" => 45,
            "stand46" => 46,
            "stand47" => 47,
            "stand48" => 48,
            "stand49" => 49,
            "stand50" => 50,
            "stand51" => 51,
            "stand52" => 52,
            "stand53" => 53,
            "stand54" => 54,
            "stand55" => 55,
            "stand56" => 56,
            "stand57" => 57,
            "stand58" => 58,
            "stand59" => 59,
            "stand60" => 60,
            "stand61" => 61,
            "stand62" => 62,
            "stand63" => 63,
            "stand64" => 64,
            "stand65" => 65,
            "stand66" => 66,
            "stand67" => 67,
            "stand68" => 68,
            "stand69" => 69,
            "stand70" => 70,

        ];

        // FECHA 1
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha1"],
                'dia_id' => $dias["dia1"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha1"],
                'dia_id' => $dias["dia2"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha1"],
                'dia_id' => $dias["dia3"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
        // FECHA 2
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha2"],
                'dia_id' => $dias["dia1"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha2"],
                'dia_id' => $dias["dia2"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha2"],
                'dia_id' => $dias["dia3"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
        // FECHA 3
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha3"],
                'dia_id' => $dias["dia1"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha3"],
                'dia_id' => $dias["dia2"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha3"],
                'dia_id' => $dias["dia3"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
        // FECHA 3
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha4"],
                'dia_id' => $dias["dia1"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha4"],
                'dia_id' => $dias["dia2"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
        foreach ($stands as $stand) {
            Disponibilidad::create([
                'fecha_id' => $fechas["fecha4"],
                'dia_id' => $dias["dia3"],
                'stand_id' => $stand,
                'estado_id' => 3,
            ]);
        }
    }
}
