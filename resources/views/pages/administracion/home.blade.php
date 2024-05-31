@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dosponibilidad</h1>
</div>

<div class="container">
    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-body">
            <section class="border p-3 mb-2">
                <div class="row d-flex align-items-center">
                    <div class="col-md">
                        <h4>Realizar una reserva</h4>
                    </div>
                    <div class="col-md text-end">
                        <a href="{{route('fechas')}}" class="btn btn-primary">Reservar</a>
                    </div>
                </div>
            </section>
            <section class="border p-3">
                <h4>Liberar espacios</h4>
                <div class="alert alert-warning fade show" role="alert">
                    <strong>Recuerda!</strong> Al presional en los botones de fechas vas a liberar todos las reservas
                    realizadas para la fecha seleccionada
                </div>
                <form action="{{ route('actualiza.disponibilidad') }}" method="post" id="frmLiberar">
                    @csrf
                    <div class="row text-center border rounded mx-1 py-3">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">FECHAS</label>
                                <select class="form-select @error('fecha') is-invalid @enderror" name="fecha">
                                    <option selected disabled>Selecciona una fecha</option>
                                    @foreach ($fechas as $f)
                                    <option value="{{ $f->id }}">{{ $f->descripcion }}</option>
                                    @endforeach
                                </select>
                                @error('fecha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">DIAS</label>
                                <select class="form-select @error('dia') is-invalid @enderror" name="dia">
                                    <option selected disabled>Selecciona un día</option>
                                    @foreach ($dias as $d)
                                    <option value="{{ $d->id }}">{{ $d->descripcion }}</option>
                                    @endforeach
                                </select>
                                @error('dia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-primary mt-3" id="liberar">Liberar</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('#liberar').on('click', function() {
        Swal.fire({
            title: "Liberar espacios?",
            text: "Vas a liberar los espacios de la fecha y dia seleccionado",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Liberar"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    allowOutsideClick: false,
                    icon: 'info',
                    iconColor: '#005ea5',
                    text: 'Un momento porfavor estamos procesamos su registro...',
                    timerProgressBar: true,
                    showConfirmButton: false,
                });
                Swal.showLoading();
                $('#frmLiberar').trigger('submit');
            }
        });
    });
    @if(Session::has('success'))
    let mensaje = "{{ Session::get('success') }}";
    console.log(mensaje);
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: mensaje,
        showConfirmButton: false,
        timer: 3500
    });
    @endif
</script>
@endpush
