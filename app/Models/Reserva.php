<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $fillable = [
        'stand_id',
        'fecha_id',
        'cliente_id',
        'dia_id',
        'estado',
        'pago_id',
    ];
}
