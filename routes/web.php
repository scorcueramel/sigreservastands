<?php

use App\Http\Controllers\DisponibilidadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ReservasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[ReservasController::class, 'index'])->name('fechas');
Route::get('/fecha/{id}/dia',[ReservasController::class, 'dias'])->name('dias');
Route::get('/fecha/{fechaid}/dia/{diaid}/disponibilidad',[ReservasController::class, 'disponibilidad'])->name('disponibilidad');
Route::get('/reservar/{fecha}/{dia}/{stand}/{id}',[ReservasController::class, 'clienteReserva'])->name('reservar');
Route::get('/volver/{fecha}/{dia}/{stand}/{id}', [ReservasController::class, 'goBack'])->name('volver');
Route::get('/recargar/{fecha}/{dia}/{stand}/{id}/pagina', [ReservasController::class, 'refreshPage'])->name('recargar');
Route::post('/generar/reserva',[ReservasController::class,'client_register'])->name('generar.registro');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/actualiza/disponibilidad/',[DisponibilidadController::class, 'actualizarDisponibilidad'])->name('actualiza.disponibilidad');
Route::get('/reservas/',[ReservaController::class, 'index'])->name('reserva.index');
Route::get('/reservaciones/{fecha}/{dia}/{estado}',[ReservaController::class, 'getReservas'])->name('reservaciones');
Route::get('/detalle-reserva/{id}',[ReservaController::class, 'detalleReservas'])->name('detalle.reserva');
Route::get('/aprobar/{id}/{fecha}/{dia}/{stand_id}/{nombres}/{correo}',[ReservaController::class, 'aprobar'])->name('aprobar.reserva');
Route::get('/rechazar/{id}/{fecha}/{dia}/{stand_id}/{nombres}/{correo}',[ReservaController::class, 'rechazar'])->name('rechazar.reserva');


