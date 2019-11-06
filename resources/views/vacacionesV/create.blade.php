@extends('layouts.app')
@section('css')
@parent
<link rel="stylesheet" href="/AdminLTE/plugins/select2/select2.min.css">
<link rel="stylesheet" href="/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.css">

@endsection
@section('js-superior')
@parent

@endsection
@section('title', 'Guia')
@section('cabecera')

<div class="col-sm-6">
    <h1 class="m-0 text-dark">Vacaciones</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">Vacaciones</li>
    </ol>
</div>


<div class="col-lg-12">
    @include('flash::message')
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
                    Solicitar Vacaciones
                </h3>
            </div>

            <div class="card-body">
                <!-- Empieza aqui -->


                <form action="{{ route('vacaciones.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-2"> 
                            <label>Periodo</label>
                            {!! Form::select('periodo_id',$periodos,null,['class' => 'form-control periodo select2','required','style'=>'width: 100%;' ,'require']) !!}
                        </div> 
                        <div class="col-md-1"> 
                            <label>Dias</label>
                            {!! Form::select('dias',[''=>''],null,['class' => 'form-control select2 diaspart','required','style'=>'width: 100%;' ,'require']) !!}
                        </div> 
                        <div class="col-md-3"> 
                            <label>Fecha de solicitud:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                <input type="text" name="rango_fecha" class="form-control float-right" id="reservation" required>
                            </div>
                        </div> 
                        <div class="col-md-2"> 
                            <label></label><br>
                            <button type="submit" class="form-control btn btn-primary">Solicitar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('js-inferior')
@parent
<script src="/AdminLTE/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="/AdminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>



<script>

    $(document).ready(function(){
        $periodo = $('.periodo').val();
        llenaSelect($periodo);
    });

    $('.periodo').change(function(event){
        llenaSelect(event.target.value);

    });

    function llenaSelect(id){
        var url = '{{route("vacaciones.show",":id")}}';
        url = url.replace(':id',id);

        $.get(url,function(response,status){
            console.log(event.target.value);
            if(response.length >= 1){
                $('.diaspart').removeAttr('disabled','disabled');
            } else {
                $('.diaspart').attr('disabled','disabled');
            }
            $('.diaspart').empty();
            $('.diaspart').append("<option value=''>Selecciona</option>");
            console.log(response);
            for(i=0;i < response.length; i++){
                $('.diaspart').append("<option value='"+response[i].cantidad_dias+"'>"+response[i].cantidad_dias+"</option>");
            }
        });
    }


    //Datemask dd/mm/yyyy
    $('#datemask2').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
</script>
@endsection
@stop