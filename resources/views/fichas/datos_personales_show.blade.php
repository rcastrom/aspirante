@extends('adminlte::page')

@section('title', 'Datos personales')

@section('content_header')
    <h1>Información registrada</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card" style="width: 30rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item active">Datos generales</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Apellido Paterno: {{$datos_personale->apellido_paterno}}</li>
                    <li class="list-group-item">Apellido Materno: {{$datos_personale->apellido_materno}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Nombre: {{$datos_personale->nombre}}</li>
                    <li class="list-group-item">
                        Fecha de nacimiento: {{date("d-m-Y",strtotime($datos_personale->fecha_nacimiento))}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Sexo: {{$datos_personale->sexo=="M"?"Masculino":"Femenino"}}</li>
                    <li class="list-group-item">
                        País de nacimiento: {{$pais->nombre}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Estado de nacimiento: {{$estado->estado}}</li>
                    <li class="list-group-item">
                        Municipio de nacimiento: {{$municipio->municipio}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Etnia: {{$etnia->nombre}}</li>
                    <li class="list-group-item">
                        CURP: {{$datos_personale->curp}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-info">
                        <strong>Carrera solicitada para ingresar: {{$carrera->nombre_carrera}}</strong></li>
                </ul>
            </div>
        </div>
        <div class="col-6">
            <div class="card" style="width: 30rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item active">Domicilio</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Calle y número {{$datos_personale->calle_numero}}</li>
                    <li class="list-group-item">
                        Colonia: {{$datos_personale->colonia}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Código Postal: {{$datos_personale->codigo_postal}}</li>
                    <li class="list-group-item">
                        Estado: {{$estado_domicilio->estado}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Municipio: {{$municipio_domicilio->municipio}}</li>
                    <li class="list-group-item">
                        Teléfono: {{$datos_personale->telefono}}</li>
                </ul>
            </div>
        </div>
    </div>
    <a href="{{route('datos_personales.edit',['datos_personale'=>$datos_personale->id])}}"><button class="btn btn-success">Editar</button></a>
@stop
