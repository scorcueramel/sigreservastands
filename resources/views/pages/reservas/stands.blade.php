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
    @if (Session::has('message'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Upsss!!</strong> {{ Session::get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Precio de stand S/. 100.00 por día</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row mb-5">
                        @foreach ($disponibilidadAdmin as $d)
                        <div class="col-md-2 my-2 text-center">
                            @if ($d->dispo_estado_id == 4)
                            <a href="{{ url('/reservar/' . $d->fec_id . '/' . $d->dia_id . '/' . $d->stand_id . '/' . $d->disp_id) }}" class="btn btn-warning btn-block btn-lg pe-none adminRegister">{{ $d->std_numero }}</a>
                            @elseif($d->dispo_estado_id == 5)
                            <a href="{{ url('/reservar/' . $d->fec_id . '/' . $d->dia_id . '/' . $d->stand_id . '/' . $d->disp_id) }}" class="btn btn-danger btn-block btn-lg pe-none adminRegister">{{ $d->std_numero }}</a>
                            @elseif ($d->dispo_estado_id == 3)
                            <a href="{{ url('/reservar/' . $d->fec_id . '/' . $d->dia_id . '/' . $d->stand_id . '/' . $d->disp_id) }}" class="btn btn-primary btn-block btn-lg pe-none adminRegister" href="#">{{ $d->std_numero }}</a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="my-5"></div>
                    <div class="row mt-5">
                        @foreach ($disponibilidadPublica as $d)
                        @if ($d->tipo != 'A')
                        <div class="col-md-2 my-2 text-center">
                            @if ($d->dispo_estado_id == 4)
                            <a href="{{ url('/reservar/' . $d->fec_id . '/' . $d->dia_id . '/' . $d->stand_id . '/' . $d->disp_id) }}" class="btn btn-warning btn-block btn-lg pe-none">{{ $d->std_numero }}</a>
                            @elseif($d->dispo_estado_id == 5)
                            <a href="{{ url('/reservar/' . $d->fec_id . '/' . $d->dia_id . '/' . $d->stand_id . '/' . $d->disp_id) }}" class="btn btn-danger btn-block btn-lg pe-none">{{ $d->std_numero }}</a>
                            @elseif ($d->dispo_estado_id == 3)
                            <a href="{{ url('/reservar/' . $d->fec_id . '/' . $d->dia_id . '/' . $d->stand_id . '/' . $d->disp_id) }}" class="btn btn-primary btn-block btn-lg">{{ $d->std_numero }}</a>
                            @endif
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        var event;
        var isLogin = @json($isLogin);
        var btns = $('.adminRegister');
        isLogin ? btns.removeClass("pe-none") : btns.attr("pe-none");
        isLogin ? btns.removeClass("adminRegister") : btns.attr("adminRegister")
    });
</script>
@endpush
