@extends('layouts.app')
@section('css')
@parent

@endsection
@section('js-superior')
@parent

@endsection
@section('title', 'Guia')
@section('cabecera')

<div class="col-sm-6">
    <h1 class="m-0 text-dark">Detalles de usuario</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
</div>


<div class="col-lg-12">
    @if (count($errors) > 0)
    <div id="notificationError" class="alert alert-danger">
        <strong>Ocurrió un problema con tus datos de entrada</strong><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(Session::has('message.nivel'))

    <div class="alert alert-{{ session('message.nivel') }} alert-dismissible" role="alert">
        <div class="m-alert__icon">
            <i class="fa fa-{{ session('message.icon') }}"></i>
        </div>
        <div class="m-alert__text">
            <strong>
                {{ session('message.title') }}
            </strong>
            {{ session('message.content') }}
        </div>
        <div class="m-alert__close">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    </div>
    @endif
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default color-palette-box">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-tag"></i>
                    <!-- Title -->
                </h3>
            </div>

            <div class="card-body">
                <!-- Empieza aqui -->
                <div class="form-group row"> 
                    <div class="col-md-6"> 
                        {!! Form::label('usuarios', 'nombre') !!}
                        {!! Form::text('name', $user_detalle->user->name, ['class' => 'form-control', 'placeholder' =>  'nombre completo' ,'readonly', 'require']) !!}
                    </div> 
                    <div class="col-md-6"> 
                        {!! Form::label('email', 'correo Electronico') !!}
                        {!! Form::email('email', $user_detalle->user->email, ['class' => 'form-control', 'placeholder' =>  'example@gmail.com' ,'readonly', 'require']) !!}
                    </div> 
                    <div class="col-md-6"> 

                    </div> 
                </div> 

                <div class="form-group row"> 
                    <div class="col-md-6"> 
                        <label>Area</label>
                        {!! Form::text('area_id',$user_detalle->area->nombre,['class' => 'form-control select2','style'=>'width: 100%;','readonly' ,'require']) !!}
                    </div> 
                    <div class="col-md-6"> 
                        <label>Cargo</label>
                        {!! Form::text('cargo_id',$user_detalle->cargo->nombre,['class' => 'form-control select2','style'=>'width: 100%;','readonly' ,'require']) !!}
                    </div> 
                </div> 
            </div>
        </div>
    </div>
</div>
@section('js-inferior')
@parent

@endsection
@stop