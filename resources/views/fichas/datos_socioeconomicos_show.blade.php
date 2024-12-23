@extends('adminlte::page')

@section('title', 'Datos socioeconómicos')

@section('content_header')
    <h1>Información registrada</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item active">Datos socioeconómicos</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Nivel máximo de estudios alcanzado por el padre (aunque haya fallecido):
                        {{$nivel_padre->descripcion}}
                    </li>
                    <li class="list-group-item list-group-item-action">
                        Nivel máximo de estudios alcanzado por la madre (aunque haya fallecido):
                        {{$nivel_madre->descripcion}}
                    </li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        ¿Con quién vives actualmente?: {{$habita}}
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item active">Ingresos familiares mensuales</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Ingreso del padre: {{$datos_socioeconomico->ingresos_padre}}
                    </li>
                    <li class="list-group-item list-group-item-action">
                        Ingreso de la madre: {{$datos_socioeconomico->ingresos_madre}}
                    </li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Ingreso de los hermanos: {{$datos_socioeconomico->ingresos_hermanos}}
                    </li>
                    <li class="list-group-item list-group-item-action">
                        Ingreso propio: {{$datos_socioeconomico->ingresos_propios}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item active">¿Cuál es la ocupación o trabajo de tus padres o tutores?</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        Por el padre: {{$ocupacion_padre->descripcion??''}}
                    </li>
                    <li class="list-group-item list-group-item-action">
                        Por la madre: {{$ocupacion_madre->descripcion??''}}
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item active">En cuanto al hogar</li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        El lugar en donde vives es: {{$casa_vives}}
                    </li>
                    <li class="list-group-item list-group-item-action">
                        ¿De quién dependes económicamente? {{$dependencia}}
                    </li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        ¿Cuántas habitaciones tiene la casa? {{$datos_socioeconomico->cuartos_casa}}
                    </li>
                    <li class="list-group-item list-group-item-action">
                        ¿Cuántas personas viven en la casa? {{$datos_socioeconomico->personas_casa}}
                    </li>
                    <li class="list-group-item list-group-item-action list-group-item-light">
                        ¿Cuántas personas incluyéndote a tí, dependen económicamente del principal apoyo o sustento?:
                        {{$datos_socioeconomico->personas_dependen}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <a href="{{route('datos_socioeconomicos.edit',['datos_socioeconomico'=>$datos_socioeconomico->id])}}">
        <button class="btn btn-success">Editar</button>
    </a>
@stop
