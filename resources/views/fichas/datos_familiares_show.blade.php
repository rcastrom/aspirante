@extends('adminlte::page')

@section('title', 'Datos familiares')

@section('content_header')
    <h1>Registro de datos familiares</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item active">Datos del padre o tutor</li>
                <li class="list-group-item list-group-item-action list-group-item-light">
                    Apellido paterno del padre: {{$datos_familiare->apellido_paterno_padre}}
                </li>
                <li class="list-group-item list-group-item-action">
                    Apellido materno del padre: {{$datos_familiare->apellido_materno_padre}}
                </li>
                <li class="list-group-item list-group-item-action list-group-item-light">
                    Nombre del padre: {{$datos_familiare->nombre_padre}}
                </li>
                <li class="list-group-item list-group-item-action">
                    ¿Aún vive?: {{$datos_familiare->vive_padre?"Sí":"No"}}
                </li>
            </ul>
        </div>
        <div class="col-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item active">Datos de la madre o tutora</li>
                <li class="list-group-item list-group-item-action list-group-item-light">
                    Apellido paterno de la madre: {{$datos_familiare->apellido_paterno_madre}}
                </li>
                <li class="list-group-item list-group-item-action">
                    Apellido materno de la madre: {{$datos_familiare->apellido_materno_madre}}
                </li>
                <li class="list-group-item list-group-item-action list-group-item-light">
                    Nombre de la madre: {{$datos_familiare->nombre_madre}}
                </li>
                <li class="list-group-item list-group-item-action">
                    ¿Aún vive?: {{$datos_familiare->vive_madre?"Sí":"No"}}
                </li>
            </ul>
        </div>
        <div class="col-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item active">Situación actual</li>
                <li class="list-group-item list-group-item-action list-group-item-light">
                    Estado civil: {{$estado_civil}}
                </li>
                <li class="list-group-item list-group-item-action">
                    ¿Cuenta con beca? {{$datos_familiare->beca?"Sí":"No"}}
                </li>
                <li class="list-group-item list-group-item-action list-group-item-light">
                    Zona de procedencia: {{$zona}}
                </li>
                <li class="list-group-item list-group-item-action">
                    Especificación de capacidad diferente: {{$datos_familiare->capacidad_diferente}}
                </li>
            </ul>
        </div>
    </div>
    <a href="{{route('datos_familiares.edit',['datos_familiare'=>$datos_familiare->id])}}">
        <button class="btn btn-success">Editar</button></a>
@stop
