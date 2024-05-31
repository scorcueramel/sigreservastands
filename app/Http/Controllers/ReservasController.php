<?php

namespace App\Http\Controllers;

use App\Mail\DetalleReservaCliente;
use App\Models\Cliente;
use Auth;
use App\Models\Dia;
use App\Models\Fecha;
use App\Models\Pago;
use App\Models\Reserva;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ReservasController extends Controller
{
    private $disk = "public";
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

        $da = $this->disponibilidadAll($fecha, $dia);
        $dp = $this->disponibilidadAll($fecha, $dia);
        $disponibilidadAdmin = $da[0];
        $disponibilidadPublica = $dp[1];

        return view("pages.reservas.stands", compact("disponibilidadPublica", "disponibilidadAdmin", "isLogin"));
    }

    public function create()
    {
        //
    }

    public function clienteReserva($fecha, $dia, $stand_id, $dispo_id)
    {
        //
        $tipo_documentos = TipoDocumento::where('estado', 'A')->get();
        $message = "";
        $disponible = DB::select('SELECT disponible FROM disponibilidads d WHERE fecha_id = ?  and dia_id = ? AND stand_id = ? AND disponible = true', [$fecha, $dia, $stand_id]);
        $disponibilidad = $disponible[0]->disponible;

        if ($disponibilidad) {
            return view("pages.cliente.registro-reserva", compact('fecha', 'dia', 'stand_id', 'dispo_id', 'tipo_documentos'));
            if ($dia == 3) {
                DB::select('UPDATE disponibilidads dp
                SET disponible = false WHERE fecha_id = ? AND dia_id = ? AND stand_id = ? AND disponible = true', [$fecha, $dia, $stand_id]);

                $r2 = DB::select('SELECT * FROM disponibilidads dp WHERE id = ? AND estado_id = 4', [$dispo_id]);

                if ($r2 != null) {
                    DB::select('UPDATE disponibilidads dp
                SET disponible = false WHERE fecha_id = ? AND dia_id = 1 AND stand_id = ? AND disponible = true', [$fecha, $stand_id]);
                    DB::select('UPDATE disponibilidads dp
                SET disponible = false WHERE fecha_id = ? AND dia_id = 2 AND stand_id = ? AND disponible = true', [$fecha, $stand_id]);
                }
                return view("pages.cliente.registro-reserva", compact('fecha', 'dia', 'stand_id', 'dispo_id', 'tipo_documentos'));
            } else {
                DB::select('UPDATE disponibilidads dp
                SET disponible = false WHERE fecha_id = ? AND dia_id = ? AND stand_id = ? AND disponible = true', [$fecha, $dia, $stand_id]);

                $r2 = DB::select('SELECT * FROM disponibilidads dp WHERE id = ? AND estado_id = 4', [$dispo_id]);

                if ($r2 != null) {
                    DB::select('UPDATE disponibilidads dp
                SET disponible = false WHERE fecha_id = ? AND dia_id = 3 AND stand_id = ? AND disponible = true', [$fecha, $stand_id]);

                    return view("pages.cliente.registro-reserva", compact('fecha', 'dia', 'stand_id', 'dispo_id', 'tipo_documentos'));
                }
            }
        } else {
            $message = "Este stand no se encuenta disponible en estos momentos, te sugerimos seleccionar otro de tu preferencia.";
            return back()->with(['message' => $message]);
        }
    }

    public function goBack($fecha, $dia, $stand_id, $dispo_id)
    {
        $isLogin = false;

        if (Auth::user() != null) {
            $isLogin = true;
        }

        $da = $this->disponibilidadAll($fecha, $dia);
        $dp = $this->disponibilidadAll($fecha, $dia);
        $disponibilidadAdmin = $da[0];
        $disponibilidadPublica = $dp[1];

        DB::select('UPDATE disponibilidads dp
                SET estado_id = 3, disponible = true WHERE fecha_id = ? AND dia_id = ? AND stand_id = ? AND id = ?', [$fecha, $dia, $stand_id, $dispo_id]);

        return view("pages.reservas.stands", compact("disponibilidadPublica", "disponibilidadAdmin", "isLogin"));
    }

    public function client_register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nombres' => ['required'], ['max:50'],
            'apepaterno' => ['required'], ['max:50'],
            'apematerno' => ['required'], ['max:50'],
            'documento_id' => ['required'],
            'documento' => ['required'], ['max:12'],
            'movil' => ['required'], ['max:15'],
            'correo' => ['required'],
            'numero_operacion' => ['required'],
            'comprobante' => ['required'],
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $cliente = Cliente::create([
            'nombres' => $request->nombres,
            'apepaterno' => $request->apepaterno,
            'apematerno' => $request->apematerno,
            'documento_id' => $request->documento_id,
            'documento' => $request->documento,
            'movil' => $request->movil,
            'correo' => $request->correo,
        ]);

        $validacompro = DB::select('select * from pagos where numero_operacion = ?',[$request->numero_operacion]);

        $pago = new Pago();
        $pago->numero_operacion = $request->numero_operacion;
        if ($imagen = $request->file('comprobante')) {
            $imgRename = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $pago['comprobante'] = "$imgRename";
            // Storage::putFileAs('', $imagen, $imgRename);
            $imagen->storeAs('/documents/', $imgRename, $this->disk);
        }
        $pago->cliente_id = $cliente->id;
        $pago->monto = $request->monto;
        $pago->duplicado = count($validacompro) ? 'SI' : 'NO';
        $pago->save();

        $reserva = Reserva::create([
            'stand_id' => $request->stand_id,
            'fecha_id' => $request->fecha,
            'dia_id' => $request->dia,
            'estado' => 'RESERVADO',
            'pago_id' => $pago->id,
        ]);


        $reserva1 = DB::table('reservas')->where('reservas.id', $reserva->id)
            ->join('pagos', 'pagos.id', '=', 'reservas.pago_id')
            ->join('fechas', 'fechas.id', '=', 'reservas.fecha_id')
            ->join('dias', 'dias.id', '=', 'reservas.dia_id')
            ->join('clientes', 'clientes.id', '=', 'pagos.cliente_id')
            ->join('stands', 'stands.id', '=', 'reservas.stand_id')
            ->select(
                'reservas.id as reserva_id',
                'reservas.estado',
                'clientes.nombres',
                'clientes.apepaterno',
                'clientes.apematerno',
                'clientes.correo',
                'clientes.documento',
                'stands.id',
                'stands.stand_nro',
                'fechas.id',
                'fechas.descripcion as fecha',
                'dias.id',
                'dias.descripcion as dia',
                'pagos.id',
                'pagos.numero_operacion',
                'pagos.comprobante'
            )
            ->get();

        Mail::to($cliente->correo)->send(new DetalleReservaCliente($reserva1[0]));

        $fecha = $request->fecha;
        $dia = $request->dia;
        $stand_id = $request->stand_id;
        $dispo_id = $request->dispo_id;

        $disponible = DB::select('SELECT disponible FROM disponibilidads d WHERE fecha_id = ?  and dia_id = ? AND stand_id = ? AND disponible = true', [$fecha, $dia, $stand_id]);
        $disponibilidad = $disponible[0]->disponible;
        if ($disponibilidad) {
            if ($dia == 3) {
                DB::select('UPDATE disponibilidads dp
            SET estado_id = 4, disponible = false WHERE fecha_id = ? AND dia_id = ? AND stand_id = ?', [$fecha, $dia, $stand_id]);

                $r2 = DB::select('SELECT * FROM disponibilidads dp WHERE id = ? AND estado_id = 4', [$dispo_id]);

                if ($r2 != null) {
                    DB::select('UPDATE disponibilidads dp
            SET estado_id = 4, disponible = false WHERE fecha_id = ? AND dia_id = 1 AND stand_id = ?', [$fecha, $stand_id]);
                    DB::select('UPDATE disponibilidads dp
            SET estado_id = 4, disponible = false WHERE fecha_id = ? AND dia_id = 2 AND stand_id = ?', [$fecha, $stand_id]);
                }
                return view('pages.reservas.reserva-exitosa', compact('cliente'));
            } else {
                DB::select('UPDATE disponibilidads dp
            SET estado_id = 4, disponible = false WHERE fecha_id = ? AND dia_id = ? AND stand_id = ?', [$fecha, $dia, $stand_id]);

                $r2 = DB::select('SELECT * FROM disponibilidads dp WHERE id = ? AND estado_id = 4', [$dispo_id]);

                if ($r2 != null) {
                    DB::select('UPDATE disponibilidads dp
            SET estado_id = 4, disponible = false WHERE fecha_id = ? AND dia_id = 3 AND stand_id = ?', [$fecha, $stand_id]);

                    return view('pages.reservas.reserva-exitosa', compact('cliente'));
                }
            }
        } else {
            $message = "Este stand no se encuenta disponible en estos momentos, te sugerimos seleccionar otro de tu preferencia.";
            return back()->with(['message' => $message]);
        }
    }

    protected function disponibilidadAll($fecha, $dia)
    {
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

        return [$disponibilidadAdmin, $disponibilidadPublica];
    }
}
