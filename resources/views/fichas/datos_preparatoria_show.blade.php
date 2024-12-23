@extends('adminlte::page')

@section('title', 'Datos preparatoria')

@section('content_header')
    <h1>Información registrada</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item active">Estudios previos</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Estado en donde cursaste la preparatoria: {{$estado->estado}}</li>
                    <li class="list-group-item">
                        Escuela Preparatoria de procedencia: {{$datos_preparatorium->nombre_preparatoria}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Año de egreso: {{$datos_preparatorium->egreso}}</li>
                    <li class="list-group-item">
                        Promedio de egreso: {{$datos_preparatorium->promedio}}</li>

                </ul>
            </div>
        </div>
    </div>
    <a href="{{route('datos_preparatoria.edit',['datos_preparatorium'=>$datos_preparatorium->id])}}"><button class="btn btn-success">Editar</button></a>
@stop
