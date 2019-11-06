@extends('layouts.app')
@section('css')
@parent

@endsection
@section('js-superior')
@parent

@endsection
@section('title', 'Usuarios')
@section('cabecera')

<div class="col-sm-6">
    <h1 class="m-0 text-dark">Usuarios</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
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
                    USUARIOS
                </h3>
            </div>

            <div class="card-body">
                <!-- Body -->
                <div class="form-group">
                    <div class="col-md-12">
                        <a href="{{route('users.create')}}" class="btn btn-primary">Agregar</a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <table class="table table-condensed">
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th style="width: 40px">Acciones</th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td style="width:40%"><a href="{{route('users.edit',$user->id)}}" class="btn btn-primary"> Editar</a>
                                    <a href="{{route('users.detalles',$user->id)}}" class="btn btn-success"> Detalles</a>
                                    &nbsp;
                                    <a href="{{route('users.eliminar',$user->id)}}" class="btn btn-danger"> Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
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