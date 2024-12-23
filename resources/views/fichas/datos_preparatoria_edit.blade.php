@extends('adminlte::page')

@section('title', 'Datos preparatoria')

@section('content_header')
    <h1>Actualización del registro de datos de la preparatoria de procedencia</h1>
@stop

@section('content')
    <h4>Por favor, completa la información solicitada</h4>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('datos_preparatoria.update',['datos_preparatorium' => $datos_preparatorium->id]) }}" method="post" role="form">
        @csrf
        @method('PUT')
        <legend>Estudios Previos</legend>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="estado_id">Estado en donde cursaste la preparatoria</label>
                <select name="estado_id" id="estado_id" class="form-control" required>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->estado_id }}" {{$estado->estado_id==$datos_preparatorium->estado_id?" selected":""}}>{{ $estado->estado }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="nombre_preparatoria">Escuela Preparatoria de procedencia</label>
                <input type="text" name="nombre_preparatoria" id="nombre_preparatoria" required
                       value="{{$datos_preparatorium->nombre_preparatoria}}"
                       onchange="this.value=this.value.toUpperCase();" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="egreso">Año de Egreso</label>
                <input type="text" name="egreso" id="egreso" required
                       value="{{$datos_preparatorium->egreso}}"
                       class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="promedio">Promedio de egreso</label>
                <input type="text" name="promedio" id="promedio"
                       value="{{$datos_preparatorium->promedio}}"
                       class="form-control" onblur="this.value=this.value.toUpperCase();" maxlength="5">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
@stop

