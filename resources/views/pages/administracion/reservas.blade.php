@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Reservas Realizadas</h1>
</div>

<div class="container">
    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-body">
            <section class="border p-3 mb-2">
                <div class="alert alert-info fade show" role="alert">
                    <strong>Buscar reservas!</strong> Selecciona las fechas y los días para encontrar las reservas realizadas
                </div>
                <form>
                    <div class="row text-center border rounded mx-1 py-3">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">FECHAS</label>
                                <select class="form-select @error('fecha') is-invalid @enderror" name="fecha" id="fecha">
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
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">DIAS</label>
                                <select class="form-select @error('dia') is-invalid @enderror" name="dia" id="dia">
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
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ESTADOS</label>
                                <select class="form-select @error('estado') is-invalid @enderror" name="estado" id="estado">
                                    <option selected disabled>Selecciona un estado</option>
                                    <option value="R">RESERVADO</option>
                                    <option value="A">ASIGNADO</option>
                                </select>
                                @error('estado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-center justify-content-end">
                            <button type="button" class="btn btn-primary mt-3" id="buscar">Buscar</button>
                        </div>
                    </div>
                </form>
            </section>
            <section class="border p-3 d-none seccion-tabla table-responsive">
                <table class="table mt-2 nowrap" id="tabla">
                    <thead>
                        <th>#</th>
                        <th>ESTADO</th>
                        <th>STAND</th>
                        <th>FECHA</th>
                        <th>DIA</th>
                        <th># OP</th>
                        <th>COMPROBANTE</th>
                        <th>NOMBRES</th>
                        <th>PATERNO</th>
                        <th>MATERNO</th>
                        <th>DOCUMENTO</th>
                        <th>MOVIL</th>
                        <th>CORREO</th>
                        <th>TIPO DOCUMENTO</th>
                        <th>OBSERVACIÓN</th>
                    </thead>
                    <tbody class="cuerpotabla"></tbody>
                </table>
            </section>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('#buscar').on('click', function() {
        let fecha = $('#fecha').val();
        let dia = $('#dia').val();
        let estado = $('#estado').val();
        $.ajax({
            type: "GET",
            url: `/reservaciones/${fecha}/${dia}/${estado}`,
            success: function(response) {
                $('.seccion-tabla').removeClass('d-none');
                $('.cuerpotabla').html('')
                $('#tabla').DataTable({
                    responsive: true,
                    stateSave: true,
                    "bDestroy": true,
                    ajax: {
                        url: `/reservaciones/${fecha}/${dia}/${estado}`,
                        type: 'GET'
                    },
                    columns: [{
                            data: 'r_id'
                        },
                        {
                            data: 'r_estado'
                        },
                        {
                            data: 's_numero'
                        },
                        {
                            data: 'f_descripcion'
                        },
                        {
                            data: 'd_descripcion'
                        },
                        {
                            data: 'p_num_op'
                        },
                        {
                            data: 'p_comprobante'
                        },
                        {
                            data: 'c_nombres'
                        },
                        {
                            data: 'c_appaterno'
                        },
                        {
                            data: 'c_apmaterno'
                        },
                        {
                            data: 'c_documento'
                        },
                        {
                            data: 'c_movil'
                        },
                        {
                            data: 'c_correo'
                        },
                        {
                            data: 'td_descripcion'
                        },
                        {
                            data: 'td_abreviatura'
                        },
                    ]
                });
            }
        });


    })
</script>
@endpush
