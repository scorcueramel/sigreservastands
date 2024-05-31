<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'numero_operacion',
        'comprobante',
        'monto',
        'duplicado',
        'cliente_id',
    ];
}
