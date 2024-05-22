<?php

namespace App\Http\Controllers;

use App\Models\Dia;
use App\Models\Disponibilidad;
use App\Models\Fecha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasController extends Controller
{
    public function index()
    {
        //
        $fechas = Fecha::where("estado","A")->get();
        return view("pages.reservas.fechas", compact("fechas"));
    }

    public function dias($id)
    {
        $fecha = $id;
        $dias = Dia::where("estado", "A")->get();
        return view("pages.reservas.dias", compact("dias","fecha"));
    }

    public function disponibilidad($fecha,$dia)
    {
        $disponibilidad = DB::select("SELECT
        dis.id as idDisp,dis.estado_id as estaDispo, e.descripcion as estaDispo,f.id as idFec ,f.descripcion as descFec ,f.estado as estaFec ,d.id as idDia ,d.descripcion as descDia ,d.estado as estaDia,
        s.id as idStadn,s.stand_nro as nroStand,s.estado as estaSatand
        FROM disponibilidads dis
        INNER JOIN fechas f
        ON f.id = dis.fecha_id
        INNER JOIN dias d
        ON d.id = dis.dia_id
        INNER JOIN stands s
        ON s.id = dis.stand_id
        INNER JOIN estados e
        ON e.id = dis.estado_id
        where f.id = ? and d.id = ?", [$fecha,$dia]);
        return view("pages.reservas.stands", compact("disponibilidad"));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
