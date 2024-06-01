@extends('layouts.reserva')
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
                        <form action="{{route('generar.registro')}}" method="POST" enctype="multipart/form-data" id="frmregistro">
                            @csrf
                            <input type="hidden" value="{{$fecha}}" name="fecha" id="fecha">
                            <input type="hidden" value="{{$dia}}" name="dia" id="dia">
                            <input type="hidden" value="{{$stand_id}}" name="stand_id" id="stand_id">
                            <input type="hidden" value="{{$dispo_id}}" name="dispo_id" id="dispo_id">
                            <input type="hidden" value="{{$precio}}" name="monto" id="monto">
                            <div class="mb-3">
                                <label for="monto" class="form-label">Monto a pagar</label>
                                <input type="text" class="form-control" value="S/. {{$precio}}.00" disabled>
                            </div>
                            @if ($fecha == 1)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Fecha seleccionada</label>
                                <input type="text" class="form-control" value="FECHA 1" disabled>
                            </div>
                            @elseif ($fecha == 2)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Fecha seleccionada</label>
                                <input type="text" class="form-control" value="FECHA 2" disabled>
                            </div>
                            @elseif ($fecha == 3)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Fecha seleccionada</label>
                                <input type="text" class="form-control" value="FECHA 3" disabled>
                            </div>
                            @elseif ($fecha == 4)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Fecha seleccionada</label>
                                <input type="text" class="form-control" value="FECHA 4" disabled>
                            </div>
                            @endif
                            @if ($dia == 1)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Día seleccionado</label>
                                <input type="text" class="form-control" value="SÁBADO" disabled>
                            </div>
                            @elseif ($dia == 2)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Día seleccionado</label>
                                <input type="text" class="form-control" value="DOMINGO" disabled>
                            </div>
                            @elseif ($dia == 3)
                            <div class="mb-3">
                                <label for="dia" class="form-label">Día seleccionado</label>
                                <input type="text" class="form-control" value="SÁBADO Y DOMINGO" disabled>
                            </div>
                            @endif
                            <div class="mb-3">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" maxlength="50" name="nombres" value="{{old('nombres')}}" id="nombres" placeholder="Ingresa tus nombres" required>
                            </div>
                            <div class="mb-3">
                                <label for="apepaterno" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" maxlength="50" name="apepaterno" value="{{old('apepaterno')}}" id="apepaterno" placeholder="Ingresa tu Apellido Paterno" required>
                            </div>
                            <div class="mb-3">
                                <label for="apematerno" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" maxlength="50" name="apematerno" value="{{old('apematerno')}}" id="apematerno" placeholder="Ingresa tu Apellido Materno" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipodocumento" class="form-label">Tipo de Documento</label>
                                <select class="form-select" name="documento_id" value="{{old('documento_id')}}" aria-label="tipodocumento">
                                    <option value="" disabled selected>Selecciona tu tipo de documento</option>
                                    @foreach ($tipo_documentos as $tp)
                                    <option value="{{$tp->id}}">{{$tp->descripcion}} ({{ $tp->abreviatura }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="documento" class="form-label">Numero de Documento</label>
                                <input type="text" class="form-control" maxlength="12" name="documento" value="{{old('documento')}}" id="documento" placeholder="Nro. de Documento de Identida" required>
                            </div>
                            <div class="mb-3">
                                <label for="movil" class="form-label">Numero de Contacto</label>
                                <input type="text" class="form-control" maxlength="15" name="movil" value="{{old('movil')}}" id="movil" placeholder="Ingresa tu Numero de Contacto" maxlength="12" required>
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="correo" value="{{old('correo')}}" id="correo" placeholder="Ingresa tu Correo Electrónico" required>
                            </div>
                            <div class="mb-3">
                                <label for="numero_operacion" class="form-label">Número de Operación</label>
                                <input type="text" class="form-control" maxlength="10" name="numero_operacion" id="numero_operacion" placeholder="Ingresa tu Número de Operación" required>
                            </div>
                            <div class="mb-3">
                                <label for="comprobante" class="form-label">Foto del comprobante</label>
                                <input class="form-control" type="file" id="comprobante" name="comprobante" {{ old('comprobante') }} aria-describedby="comprobante" required>
                                <div id="comprobante" class="form-text">
                                    Sube la foto de tu comprobante de págo
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Realizar Reserva</button>
                                <a href="{{ url('/volver/'.$fecha.'/'.$dia.'/'.$stand_id.'/'.$dispo_id) }}" class="btn btn-danger">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    window.onbeforeunload = function(e) {
        let fecha = $('#fecha').val();
        let dia = $('#dia').val();
        let stand_id = $('#stand_id').val();
        let dispo_id = $('#dispo_id').val();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            type: "GET",
            url: `/recargar/${fecha}/${dia}/${stand}/${id}/pagina`,
            success: function(response) {
                console.log(response);
            }
        });
        console.log(fecha,dia,stand_id,dispo_id);
    };


    $('#frmregistro').submit((e) => {
        Swal.fire({
            allowOutsideClick: false,
            icon: 'info',
            iconColor: '#005ea5',
            text: 'Un momento porfavor estamos procesamos su registro...',
            timerProgressBar: true,
            showConfirmButton: false,
        });
        Swal.showLoading();
    });
</script>
@endpush
