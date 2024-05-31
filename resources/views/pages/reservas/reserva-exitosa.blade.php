@extends('layouts.reserva')

@section('content')
<div class="b-example-divider"></div>
<h1 class="visually-hidden">Heroes examples</h1>

<div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="display-5 fw-bold text-body-emphasis">Tu inscripción fue registrada</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Hola, <strong>{{$cliente->nombres}} {{$cliente->apepaterno}} {{$cliente->apematerno}}</strong></p>
        <p>Nuestro equipo se contactará contigo. Te llegará un mensaje con una tarjeta de registro al correo ingresado</p>
        <p>¡Gracias por Inscribirte.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="/" class="btn btn-primary btn-lg px-4 gap-3">Regersar al Inicio</a>
        </div>
    </div>
</div>

<div class="b-example-divider"></div>

@endsection
