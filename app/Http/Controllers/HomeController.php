<?php

namespace App\Http\Controllers;

use App\Models\Dia;
use App\Models\Fecha;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $fechas = Fecha::where('estado', 'A')->get();
        $dias = Dia::where('estado', 'A')->get();

        return view('pages.administracion.home', compact('fechas','dias'));
    }
}
