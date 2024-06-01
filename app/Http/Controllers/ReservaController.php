<?php

namespace App\Http\Controllers;

use App\Mail\Aprobado;
use App\Mail\Rechazar;
use App\Models\Dia;

use App\Models\Fecha;
use App\Models\Reserva;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class ReservaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fechas = Fecha::where('estado', 'A')->get();
        $dias = Dia::where('estado', 'A')->get();

        return view('pages.administracion.reservas', compact('fechas', 'dias'));
    }

    public function getReservas($fecha, $dia, $estado)
    {
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
                'clientes.nombres as c_nombres',
                'clientes.apepaterno as c_appaterno',
                'clientes.apematerno as c_apmaterno',
                'clientes.documento as c_documento',
                'clientes.movil  as c_movil',
                'tipo_documentos.descripcion as td_descripcion',
            )
            ->where('fechas.id', '=', $fecha)
            ->where('dias.id', '=', $dia)
            ->where('reservas.estado', '=', $estado)
            ->get();
        // return DataTables::collection($reservas)->toJson();
        return DataTables::collection($reservas)
            ->addColumn('detalles', function ($row) {
                return '<td>
                            <a href="/detalle-reserva/'.$row['r_id'].'" class="btn btn-danger btn-sm detalle">
                                <i class="fa-solid fa-circle-info me-1"></i>
                            </a>
                        </td>';
            })
            ->addColumn('nombres_apellidos', function ($row) {
                return '<td>'
                         .''.$row['c_nombres'].' '.$row['c_appaterno'].' '.$row['c_apmaterno'].''.
                        '</td>';
            })
            ->rawColumns(['detalles','nombres_apellidos'])
            ->make(true);
    }

    public function detalleReservas($id){
        $reservaDetalle = DB::select('select
        r.id as r_id, r.estado as r_estado, s.id as s_id ,s.stand_nro as s_nro_stand,f.id as f_id, f.descripcion as f_descripcion,
        d.id as d_id,d.descripcion as d_descripcion, p.numero_operacion as p_nro_op, p.comprobante as p_comprobante,
        p.monto as p_monto, c.nombres as c_nombres, c.apepaterno as c_paterno, c.apematerno as c_materno,
        c.documento as c_documento, c.documento as c_documento, c.movil as c_movil, c.correo as c_correo,
        td.descripcion as td_descripcion
        from reservas r
        left join stands s on s.id = r.stand_id
        left join fechas f on f.id = r.fecha_id
        left join dias d on d.id = r.dia_id
        left join pagos p on p.id = r.pago_id
        left join clientes c on c.id = p.cliente_id
        left join tipo_documentos td on td.id = c.documento_id
        where r.id = ?', [$id]);

        $detalles = $reservaDetalle[0];

        return view('pages.administracion.detalle-reserva', compact('detalles'));
    }

    public function aprobar($id, $fecha, $dia, $stand_id, $nombres, $correo){
        DB::select('UPDATE disponibilidads
                                    SET estado_id = 5
                                    WHERE fecha_id=? AND dia_id=? AND stand_id=?',[$fecha,$dia, $stand_id]);
        DB::select("UPDATE reservas
                    SET estado = 'ASIGNADO'
                    WHERE id=?",[$id]);

        Mail::to($correo)->send(new Aprobado($nombres));

        return back()->with("success","El registro fue aprobado con exito!");
    }

    public function rechazar($id, $fecha, $dia, $stand_id, $nombres, $correo){
        DB::select('UPDATE disponibilidads
                                    SET estado_id = 3
                                    WHERE fecha_id=? AND dia_id=? AND stand_id=?',[$fecha,$dia, $stand_id]);
        DB::select("UPDATE reservas
                    SET estado = 'ASIGNADO'
                    WHERE id=?",[$id]);

        Mail::to($correo)->send(new Rechazar($nombres));

        return back()->with("success","El registro fue rechazado");
    }
}
