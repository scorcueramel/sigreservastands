@extends('layouts.reserva')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        @foreach ($fechas as $fecha)
                        <div class="col-md-12 my-2 text-center">
                            <a class="btn btn-primary btn-block btn-lg" href="{{route('dias',$fecha->id)}}" role="button">{{$fecha->descripcion}}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
