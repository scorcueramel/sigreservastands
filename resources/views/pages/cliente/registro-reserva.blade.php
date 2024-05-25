@extends('layouts.app')
@push('css')
<style>
    .adminRegister {
        background: gray !important;
        border: none !important;
    }
</style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h1 class="text-center">REALIZA TU RESERVA</h1>

                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        <strong>A tener en cuenta!</strong> <br>
                        <ul>
                            <li>
                                Primero debes realizar el pago correspondiente para continuar con tu reserva.
                            </li>
                            <li>
                                Debes rellenar todos los datos del formulario.
                            </li>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="row mb-2">
                        <form action="" method="post">
                            <input type="hidden" value="{{$fecha}}">
                            <input type="hidden" value="{{$dia}}">
                            <input type="hidden" value="{{$stand_id}}">
                            <input type="hidden" value="{{$dispo_id}}">
                            @if ($fecha == 1)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Fecha seleccionada</label>
                                <input type="text" class="form-control" id="dia" value="FECHA 1" disabled>
                            </div>
                            @elseif ($fecha == 2)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Fecha seleccionada</label>
                                <input type="text" class="form-control" id="dia" value="FECHA 2" disabled>
                            </div>
                            @elseif ($fecha == 3)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Fecha seleccionada</label>
                                <input type="text" class="form-control" id="dia" value="FECHA 3" disabled>
                            </div>
                            @elseif ($fecha == 4)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Fecha seleccionada</label>
                                <input type="text" class="form-control" id="dia" value="FECHA 4" disabled>
                            </div>
                            @endif
                            @if ($dia == 1)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Día seleccionado</label>
                                <input type="text" class="form-control" id="dia" value="SÁBADO" disabled>
                            </div>
                            @elseif ($dia == 2)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Día seleccionado</label>
                                <input type="text" class="form-control" id="dia" value="DOMINGO" disabled>
                            </div>
                            @elseif ($dia == 3)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Día seleccionado</label>
                                <input type="text" class="form-control" id="dia" value="SÁBADO Y DOMINGO" disabled>
                            </div>
                            @endif
                            <div class="mb-3">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" max="50" class="form-control" id="nombres" placeholder="Ingresa tus nombres" required>
                            </div>
                            <div class="mb-3">
                                <label for="apepaterno" class="form-label">Apellido Paterno</label>
                                <input type="text" max="50" class="form-control" id="apepaterno" placeholder="Ingresa tu Apellido Paterno" required>
                            </div>
                            <div class="mb-3">
                                <label for="apematerno" class="form-label">Apellido Materno</label>
                                <input type="text" max="50" class="form-control" id="apematerno" placeholder="Ingresa tu Apellido Materno" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipodocumento" class="form-label">Tipo de Documento</label>
                                <select class="form-select" aria-label="tipodocumento">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="movil" class="form-label">Numero de Contacto</label>
                                <input type="text" max="15" class="form-control" id="movil" placeholder="Ingresa tu Numero de Contacto" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" placeholder="Ingresa tu Numero Correo Electrónico">
                            </div>
                            <div class="mb-3">
                                <label for="movil" class="form-label">Número de Operación</label>
                                <input type="text" max="25" class="form-control" id="movil" placeholder="Ingresa tu Número de Operación" required>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Foto del comprobante</label>
                                <input class="form-control" type="file" id="formFile" aria-describedby="comprobante">
                                <div id="comprobante" class="form-text">
                                    Sube la foto de tu comprobante de págo
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Realizar Reserva</button>
                                <button type="button" class="btn btn-danger">Volver</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
