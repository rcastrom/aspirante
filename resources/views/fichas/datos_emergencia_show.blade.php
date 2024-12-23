@extends('adminlte::page')

@section('title', 'Datos emergencia')

@section('content_header')
    <h1>Información registrada</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item active">Datos generales</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">Tipo de Sangre
                    {{$tipo_sangre->tipo_sangre}}</li>
                    <li class="list-group-item list-group-item-action">¿Presentas algún tipo de emergencia?
                        {{$datos_emergencium->tipo_alergia??""}}
                    </li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        ¿Presentas alguna enfermedad que requiera consideración particular?
                        {{$datos_emergencium->enfermedad??""}}
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item active">Datos de la persona para contactar en caso de emergencia</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Nombre de la persona con quien se puede contactar en caso de emergencia
                        {{$datos_emergencium->comunicar_con??""}}
                    </li>
                    <li class="list-group-item list-group-item-action">Calle y número
                        {{$datos_emergencium->calle_numero??""}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">Colonia
                        {{$datos_emergencium->colonia??""}}</li>
                    <li class="list-group-item list-group-item-action">Municipio
                        {{$datos_emergencium->municipio??""}}</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Teléfono de contacto {{$datos_emergencium->telefono_contacto??""}}
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item active">Lugar de trabajo de la persona por contactar</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        ¿Dónde trabaja la persona de contacto?
                        {{$datos_emergencium->lugar_trabajo??""}}
                    </li>
                    <li class="list-group-item list-group-item-action">Teléfono del trabajo de la persona
                        {{$datos_emergencium->telefono_trabajo??""}}</li>
                </ul>
            </div>
        </div>
    </div>
    <a href="{{route('datos_emergencia.edit',['datos_emergencium'=>$datos_emergencium->id])}}">
        <button class="btn btn-success">Editar</button>
    </a>
@stop

