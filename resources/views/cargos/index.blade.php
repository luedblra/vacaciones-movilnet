@extends('layouts.app')
@section('css')
@parent

@endsection
@section('js-superior')
@parent

@endsection
@section('title', 'Cargos')
@section('cabecera')

<div class="col-sm-6">
    <h1 class="m-0 text-dark">Cargos</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">Cargos</li>
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
                    <!-- Title -->Cargos
                </h3>
            </div>

            <div class="card-body">
                <!-- Empieza aqui -->
                <div class="form-group">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-success" href="{{ route('cargos.create') }}">AÑADIR CARGO</a>
                    </div>
                </div>
                <div class="form-group">
                    <table class="table table-condensed">
                        <tr>
                            <th>No</th>
                            <th>Nombre</th>
                            <th width="280px">Accion</th>
                        </tr>
                        @foreach ($cargos as $cargo)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $cargo->nombre }}</td>
                            <td>
                                <form
                                      onsubmit="return confirm('CONFIRMAR ELIMINAR CARGO');"
                                      action="{{ route('cargos.destroy', $cargo->id) }}"
                                      method="POST"
                                      >

                                    <!--<a class="btn btn-info" href="{{ route('cargos.show',$cargo->id) }}">VER</a>-->

                                    <a class="btn btn-primary" href="{{ route('cargos.edit',$cargo->id) }}">EDITAR</a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">ELIMINAR</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    {!! $cargos->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@section('js-inferior')
@parent

@endsection
@stop