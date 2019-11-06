@extends('layouts.app')
@section('css')
@parent

@endsection
@section('js-superior')
@parent

@endsection
@section('title', 'Periodos')
@section('cabecera')

<div class="col-sm-6">
    <h1 class="m-0 text-dark">Periodos</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">Periodos</li>
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
                    Agregar Periodos
                </h3>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('periodos.create') }}">AÑADIR PERIODO</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <table class="table table table-condensed">
                        <tr>
                            <th>N°</th>
                            <th>Rango</th>
                            <th>Dias Disponibles</th>
                            <th width="280px">Accion</th>
                        </tr>
                        @foreach ($periodos as $periodo)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $periodo->rango }}</td>
                            <td>{{ $periodo->dias_disp }}</td>
                            <td>
                                <form
                                      onsubmit="return confirm('CONFIRMAR ELIMINAR PERIODO');"
                                      action="{{ route('periodos.destroy', $periodo->id) }}"
                                      method="POST"
                                      >

<!--                                    <a class="btn btn-info" href="{{ route('periodos.show',$periodo->id) }}">VER</a>-->

                                    <a class="btn btn-primary" href="{{ route('periodos.edit',$periodo->id) }}">EDITAR</a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">ELIMINAR</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    {!! $periodos->links() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@section('js-inferior')
@parent

@endsection
@stop