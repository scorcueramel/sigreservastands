@extends('layouts.app')
@push('css')
    <style>
        .adminRegister{
            background: gray !important;
            border: none !important;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

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
                                            <a href="{{ url('/reservar/'.$d->fec_id.'/'.$d->dia_id.'/'.$d->stand_id.'/'.$d->disp_id) }}" class="btn btn-warning btn-block btn-lg pe-none adminRegister" role="button">{{ $d->std_numero }}</a>
                                        @elseif($d->dispo_estado_id == 5)
                                            <a href="{{ url('/reservar/'.$d->fec_id.'/'.$d->dia_id.'/'.$d->stand_id.'/'.$d->disp_id) }}" class="btn btn-danger btn-block btn-lg pe-none adminRegister" role="button">{{ $d->std_numero }}</a>
                                        @elseif ($d->dispo_estado_id == 3)
                                            <a href="{{ url('/reservar/'.$d->fec_id.'/'.$d->dia_id.'/'.$d->stand_id.'/'.$d->disp_id) }}" class="btn btn-primary btn-block btn-lg pe-none adminRegister" href="#" role="button">{{ $d->std_numero }}</a>
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
                                            <a href="{{ url('/reservar/'.$d->fec_id.'/'.$d->dia_id.'/'.$d->stand_id.'/'.$d->disp_id) }}" class="btn btn-warning btn-block btn-lg pe-none" role="button"
                                                disabled>{{ $d->std_numero }}</a>
                                        @elseif($d->dispo_estado_id == 5)
                                            <a href="{{ url('/reservar/'.$d->fec_id.'/'.$d->dia_id.'/'.$d->stand_id.'/'.$d->disp_id) }}" class="btn btn-danger btn-block btn-lg pe-none" role="button"
                                                disabled>{{ $d->std_numero }}</a>
                                        @elseif ($d->dispo_estado_id == 3)
                                            <a href="{{ url('/reservar/'.$d->fec_id.'/'.$d->dia_id.'/'.$d->stand_id.'/'.$d->disp_id) }}" class="btn btn-primary btn-block btn-lg" role="button">{{ $d->std_numero }}</a>
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
        $(document).ready(function () {
            var isLogin = @json($isLogin);
            var btns = $('.adminRegister');
            isLogin ? btns.removeClass("pe-none") : btns.attr("pe-none");
        });
    </script>
@endpush
