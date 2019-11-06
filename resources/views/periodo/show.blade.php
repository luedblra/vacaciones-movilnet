@extends('layouts.app')
@section('css')
@parent

@endsection
@section('js-superior')
@parent

@endsection
@section('title', 'Guia')
@section('cabecera')
<!-- ALGO -->
@endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>DETALLES CARGO</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('periodos.index') }}">VOLVER</a>
            </div>
        </div>
    </div>

    <br>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Rango:</strong>
                {{ $periodo->rango }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Dias disponibles:</strong>
                {{ $periodo->dias_disp }}
            </div>
        </div>
    </div>


@section('js-inferior')
@parent

@endsection
@stop