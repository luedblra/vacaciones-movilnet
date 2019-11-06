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
                <h2>DETALLES AREA</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('areas.index') }}">VOLVER</a>
            </div>
        </div>
    </div>

    <br>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $area->nombre }}
            </div>
        </div>
    </div>


@section('js-inferior')
@parent

@endsection
@stop