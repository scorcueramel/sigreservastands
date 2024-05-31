<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DisponibilidadController extends Controller
{
    //
    public function actualizarDisponibilidad(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'fecha' => ['required'],
            'dia' => ['required']
        ], [
            'fecha.required' => 'Es obligatorio elegir una fecha',
            'dia.required' => 'Es obligatorio elegir un dia',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $fecha = $request->fecha;
        $dia = $request->dia;


        if($dia == 3){
            DB::select('update disponibilidads
            set disponible = true, estado_id = 3
            where fecha_id = ? and dia_id = 1', [$fecha]);
            DB::select('update disponibilidads
            set disponible = true, estado_id = 3
            where fecha_id = ? and dia_id = 2', [$fecha]);
            DB::select('update disponibilidads
            set disponible = true, estado_id = 3
            where fecha_id = ? and dia_id = 3', [$fecha]);
        }else{
            DB::select('update disponibilidads
            set disponible = true, estado_id = 3
            where fecha_id = ? and dia_id = ?', [$fecha, $dia]);
            DB::select('update disponibilidads
            set disponible = true, estado_id = 3
            where fecha_id = ? and dia_id = 3', [$fecha]);
        }

        return redirect()->back()->with(['success' => 'Ahora todos los stands de la fecha y dia seleccionados se encuentran disponibles']);
    }
}
