<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_id',
        'dia_id',
        'stand_id',
        'estado_id',
    ];
}
