<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Dia;
use App\Models\Fecha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasController extends Controller
{
    public function index()
    {
        //
        $fechas = Fecha::where("estado", "A")->get();
        return view("pages.reservas.fechas", compact("fechas"));
    }

    public function dias($id)
    {
        $fecha = $id;
        $dias = Dia::where("estado", "A")->get();
        return view("pages.reservas.dias", compact("dias", "fecha"));
    }

    public function disponibilidad($fecha, $dia)
    {
        $isLogin = false;

        if (Auth::user() != null) {
            $isLogin = true;
        }

        $disponibilidadAdmin = DB::select("SELECT
                                            dis.id as disp_id, dis.estado_id as dispo_estado_id, dis.stand_id as stand_id,dis.tipo, e.descripcion as dispo_descripcion,
                                            f.id as fec_id , f.descripcion as fec_descripcion, f.estado as fec_estado, d.id as dia_id,
                                            d.descripcion as dia_descripcion, d.estado as dia_estado,
                                            s.id as std_id, s.stand_nro as std_numero, s.estado as std_estado
                                            FROM disponibilidads dis
                                            INNER JOIN fechas f
                                            ON f.id = dis.fecha_id
                                            INNER JOIN dias d
                                            ON d.id = dis.dia_id
                                            INNER JOIN stands s
                                            ON s.id = dis.stand_id
                                            INNER JOIN estados e
                                            ON e.id = dis.estado_id
                                            WHERE dis.tipo  = 'A'
                                            AND f.id = ?
                                            AND d.id = ?
                                            ORDER BY disp_id ASC", [$fecha, $dia]);

        $disponibilidadPublica = DB::select("SELECT
                                            dis.id as disp_id, dis.estado_id as dispo_estado_id, dis.stand_id as stand_id,dis.tipo as tipo, e.descripcion as dispo_descripcion,
                                            f.id as fec_id , f.descripcion as fec_descripcion, f.estado as fec_estado, d.id as dia_id,
                                            d.descripcion as dia_descripcion, d.estado as dia_estado,
                                            s.id as std_id, s.stand_nro as std_numero, s.estado as std_estado
                                            FROM disponibilidads dis
                                            INNER JOIN fechas f
                                            ON f.id = dis.fecha_id
                                            INNER JOIN dias d
                                            ON d.id = dis.dia_id
                                            INNER JOIN stands s
                                            ON s.id = dis.stand_id
                                            INNER JOIN estados e
                                            ON e.id = dis.estado_id
                                            WHERE f.id = ? and d.id = ?
        ORDER BY disp_id", [$fecha, $dia]);
        return view("pages.reservas.stands", compact("disponibilidadPublica", "disponibilidadAdmin", "isLogin"));
    }

    public function create()
    {
        //
    }

    public function store($fecha, $dia, $stand_id, $dispo_id)
    {
        //
        if ($dia == 3) {
            DB::select('UPDATE disponibilidads dp
            SET estado_id = 4 WHERE fecha_id = ? AND dia_id = ? AND stand_id = ?', [$fecha, $dia, $stand_id]);

            $r2 = DB::select('SELECT * FROM disponibilidads dp WHERE id = ? AND estado_id = 4', [$dispo_id]);

            if ($r2 != null) {
                DB::select('UPDATE disponibilidads dp
                SET estado_id = 4 WHERE fecha_id = ? AND dia_id = 1 AND stand_id = ?', [$fecha, $stand_id]);
                DB::select('UPDATE disponibilidads dp
                SET estado_id = 4 WHERE fecha_id = ? AND dia_id = 2 AND stand_id = ?', [$fecha, $stand_id]);
                return view("pages.cliente.registro-reserva", compact('fecha','dia','stand_id','dispo_id'));
            }
        } else {

            DB::select('UPDATE disponibilidads dp
            SET estado_id = 4 WHERE fecha_id = ? AND dia_id = ? AND stand_id = ?', [$fecha, $dia, $stand_id]);

            $r2 = DB::select('SELECT * FROM disponibilidads dp WHERE id = ? AND estado_id = 4', [$dispo_id]);

            if ($r2 != null) {
                DB::select('UPDATE disponibilidads dp
                SET estado_id = 4 WHERE fecha_id = ? AND dia_id = 3 AND stand_id = ?', [$fecha, $stand_id]);
                return view("pages.cliente.registro-reserva", compact('fecha','dia','stand_id','dispo_id'));
            }
        }
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
