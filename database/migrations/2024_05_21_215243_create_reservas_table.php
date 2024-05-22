<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stand_id')->constrained('stands');
            $table->foreignId('fecha_id')->constrained('fechas');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('dia_id')->constrained('dias');
            $table->foreignId('estado_id')->constrained('estados');
            $table->foreignId('pago_id')->constrained('pagos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};