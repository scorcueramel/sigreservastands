<?php

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
Route::get('/reservar/{fecha}/{dia}/{stand}/{id}',[ReservasController::class, 'store'])->name('reservar');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
