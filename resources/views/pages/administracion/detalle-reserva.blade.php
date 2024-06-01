@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Reserva de : <strong>{{$detalles->c_nombres}} {{$detalles->c_paterno}} {{$detalles->c_materno}}</strong></h1>
</div>

<div class="container">
    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-body">
            <section class="border p-3 mb-2">
                <div class="alert alert-primary fade show" role="alert">
                    <strong>Detalles de Reserva</strong> Desde este apartado puedes, validar, aprobar y rechazar las solicitudes de reservas.
                </div>
            </section>
            <section class="border p-3 seccion-tabla table-responsive">

                <div class="row mb-3">
                    <div class="col-md">
                        <button type="button" data-id="{{$detalles->r_id}}" class="btn btn-sm btn-primary" id="aprobar">Aprobar</button>
                        <button type="button" class="btn btn-sm btn-danger mx-5" id="rechazar">Rechazar</button>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="imagen">Ver Comprobante</button>
                    </div>
                    <div class="col-md text-end">
                        <a href="{{route('reserva.index')}}" class="btn btn-sm btn-warning">Volver</a>
                    </div>
                </div>

                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="text-primary">Número de Operación</div>
                            <div class="fw-bold ms-4">> {{ $detalles->p_nro_op }}</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="text-primary">Número de Operación Duplicado</div>
                            <div class="fw-bold ms-4">> {{ $detalles->p_duplicado }}</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="text-primary">Monto Abonado</div>
                            <div class="fw-bold ms-4">> S/. {{ $detalles->p_monto }}.00</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="text-primary">Estado de la Reserva</div>
                            <div class="fw-bold ms-4">> {{ $detalles->r_estado }}</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="text-primary">Nombres</div>
                            <div class="fw-bold ms-4">> {{ $detalles->c_nombres }} {{ $detalles->c_paterno }} {{ $detalles->c_materno }} </div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="text-primary">Número de Documento</div>
                            <div class="fw-bold ms-4">> {{ $detalles->c_documento }} </div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="text-primary">Movil</div>
                            <div class="fw-bold ms-4">> {{ $detalles->c_movil }} </div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="text-primary">Correo</div>
                            <div class="fw-bold ms-4">> {{ $detalles->c_correo }} </div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="text-primary">Número de Stand</div>
                            <div class="fw-bold ms-4">> {{ $detalles->s_nro_stand }}</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="text-primary">Fechas de Reserva</div>
                            <div class="fw-bold ms-4">> {{ $detalles->f_descripcion }}</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="text-primary">Dia de Reserva</div>
                            <div class="fw-bold ms-4">> {{ $detalles->d_descripcion }}</div>
                        </div>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md text-center">
                        <img src="{{asset('/storage/documents/'.$detalles->p_comprobante)}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('#aprobar').on('click', function() {
        Swal.fire({
            title: "Aprobar el registro?",
            html: "Vas a aprobar el registro de <br><strong>{{$detalles->c_nombres}} {{$detalles->c_paterno}} {{$detalles->c_materno}}</strong>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Aprobar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                let id = "{{ $detalles->r_id }}";
                let fecha = "{{ $detalles->s_id }}";
                let dia = "{{ $detalles->f_id }}";
                let stand_id = "{{ $detalles->d_id }}";
                let nombres = "{{ $detalles->c_nombres }}";
                let correo = "{{ $detalles->c_correo }}";
                Swal.fire({
                    allowOutsideClick: false,
                    icon: 'info',
                    iconColor: '#005ea5',
                    text: 'Un momento se está notificando a {{$detalles->c_nombres}} su aprobación...',
                    timerProgressBar: true,
                    showConfirmButton: false,
                });
                Swal.showLoading();
                $.ajax({
                    type: "GET",
                    url: `/aprobar/${id}/${fecha}/${dia}/${stand_id}/${nombres}/${correo}`,
                    success: function(response) {
                        Swal.close();
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: 'Reserva Asignada a {{$detalles->c_nombres}} ',
                            showConfirmButton: false,
                            timer: 3500
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 1200);

                    }
                });

            }
        });
    });

    $('#rechazar').on('click', function() {
        Swal.fire({
            title: "Rechazar el registro?",
            html: "Vas a rechazar el registro de <br><strong>{{$detalles->c_nombres}} {{$detalles->c_paterno}} {{$detalles->c_materno}}</strong>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Rechazar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    allowOutsideClick: false,
                    icon: 'info',
                    iconColor: '#005ea5',
                    text: 'Un momento se está notificando a {{$detalles->c_nombres}} su rechazo...',
                    timerProgressBar: true,
                    showConfirmButton: false,
                });
                Swal.showLoading();
            }
        });
    });

    $(document).ready(function() {
        let estado = `{{ $detalles->r_estado }}`;

        if (estado == 'ASIGNADO') {
            $('#aprobar').attr('disabled', 'disabled');
            $('#rechazar').attr('disabled', 'disabled');
        } else if (estado == 'RECHAZADO') {
            $('#aprobar').attr('disabled', 'disabled');
            $('#rechazar').attr('disabled', 'disabled');
        }
    });
</script>
@endpush
