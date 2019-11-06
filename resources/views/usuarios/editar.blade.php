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
    <h1 class="m-0 text-dark">Usuarios</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
        <li class="breadcrumb-item active">Editar</li>
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
                    <!-- Title -->Editar
                </h3>
            </div>

            <div class="card-body">
                <!-- Body -->

                <h3></h3>
                {!! Form::open(['route' => ['users.update',$user->id], 'method' =>  'PUT']) !!} 

                <div class="form-group row"> 
                    <div class="col-md-4"> 
                        {!! Form::label('usuarios', 'Nombre') !!}
                        {!! Form::text('usuarios', $user->name, ['class' => 'form-control', 'placeholder' =>  'nombre completo' , 'require']) !!}
                    </div> 

                    <div class="col-md-4"> 
                        {!! Form::label('email', 'correo Electronico') !!}
                        {!! Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' =>  'example@gmail.com' , 'require']) !!}
                    </div> 

                    <div class="col-md-4"> 
                        {!! Form::label('password', 'contraseña') !!}
                        {!! Form::password('password',['class' => 'form-control', 'require']) !!}
                    </div> 
                </div> 

                <div class="form-group row"> 
                    <div class="col-md-4"> 
                        <label>Area</label>
                        {!! Form::select('area_id',$area,$area_id,['class' => 'form-control select2','style'=>'width: 100%;' ,'require']) !!}
                    </div> 
                    <div class="col-md-4"> 
                        <label>Cargo</label>
                        {!! Form::select('cargo_id',$cargo_all,$cargo_id,['class' => 'form-control select2','style'=>'width: 100%;' ,'require']) !!}
                    </div> 
                </div> 
                <div class="form-group"> 
                    {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                </div> 





                {!! form::close() !!} 









            </div> 
        </div> 
    </div>
</div>
@section('js-inferior')
@parent

@endsection
@stop