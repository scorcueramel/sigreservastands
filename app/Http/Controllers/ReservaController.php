<?php

namespace App\Http\Controllers;

use App\Models\Dia;

use App\Models\Fecha;
use App\Models\Reserva;

use Yajra\DataTables\Facades\DataTables;

class ReservaController extends Controller
{
    //
    public function index()
    {

        $fechas = Fecha::where('estado', 'A')->get();
        $dias = Dia::where('estado', 'A')->get();

        return view('pages.administracion.reservas', compact('fechas', 'dias'));
    }

    public function getReservas($fecha, $dia, $estado)
    {
        // $reservas = Reserva::leftJoin('stands', 'stands.id', '=', 'reservas.stand_id')
        //     ->leftJoin('fechas', 'fechas.id', '=', 'reservas.fecha_id')
        //     ->leftJoin('dias', 'dias.id', '=', 'reservas.dia_id')
        //     ->leftJoin('pagos', 'pagos.id', '=', 'reservas.pago_id')
        //     ->leftJoin('clientes', 'clientes.id', '=', 'pagos.cliente_id')
        //     ->leftJoin('tipo_documentos', 'tipo_documentos.id', '=', 'clientes.documento_id')
        //     ->select(
        //         'reservas.id as r_id',
        //         'reservas.estado as r_estado',
        //         'stands.stand_nro as s_numero',
        //         'fechas.descripcion as f_descripcion',
        //         'dias.descripcion as d_descripcion',
        //         'pagos.numero_operacion as p_num_op',
        //         'pagos.comprobante as p_comprobante',
        //         'clientes.nombres as c_nombres',
        //         'clientes.apepaterno as c_appaterno',
        //         'clientes.apematerno as c_apmaterno',
        //         'clientes.documento_id as c_documento',
        //         'clientes.movil  as c_movil',
        //         'clientes.correo as c_correo',
        //         'tipo_documentos.descripcion as td_descripcion',
        //         'tipo_documentos.abreviatura as td_abreviatura'
        //     )
        //     ->where('fechas.id', '=', $fecha)
        //     ->where('dias.id', '=', $dia)
        //     ->where('reservas.estado', '=', $estado)
        //     ->paginate(10);
        //     return $reservas;


        $reservas = Reserva::leftJoin('stands', 'stands.id', '=', 'reservas.stand_id')
            ->leftJoin('fechas', 'fechas.id', '=', 'reservas.fecha_id')
            ->leftJoin('dias', 'dias.id', '=', 'reservas.dia_id')
            ->leftJoin('pagos', 'pagos.id', '=', 'reservas.pago_id')
            ->leftJoin('clientes', 'clientes.id', '=', 'pagos.cliente_id')
            ->leftJoin('tipo_documentos', 'tipo_documentos.id', '=', 'clientes.documento_id')
            ->select(
                'reservas.id as r_id',
                'reservas.estado as r_estado',
                'stands.stand_nro as s_numero',
                'fechas.descripcion as f_descripcion',
                'dias.descripcion as d_descripcion',
                'pagos.numero_operacion as p_num_op',
                'pagos.comprobante as p_comprobante',
                'clientes.nombres as c_nombres',
                'clientes.apepaterno as c_appaterno',
                'clientes.apematerno as c_apmaterno',
                'clientes.documento_id as c_documento',
                'clientes.movil  as c_movil',
                'clientes.correo as c_correo',
                'tipo_documentos.descripcion as td_descripcion',
                'tipo_documentos.abreviatura as td_abreviatura'
            )
            ->where('fechas.id', '=', $fecha)
            ->where('dias.id', '=', $dia)
            ->where('reservas.estado', '=', $estado)
            ->get();
            return DataTables::collection($reservas)->toJson();
    }
}
