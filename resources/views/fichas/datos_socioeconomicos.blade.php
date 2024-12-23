@extends('adminlte::page')

@section('title', 'Datos socioeconómicos')

@section('content_header')
    <h1>Registro de datos socioeconómicos</h1>
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
    <form action="{{ route('datos_socioeconomicos.store') }}" method="post" role="form">
        @csrf
        <legend>Datos SocioEconómicos</legend>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="nivel_estudios_padre_id">Nivel máximo de estudios alcanzado por
                    el padre (aunque haya fallecido)</label>
                <select name="nivel_estudios_padre_id" id="nivel_estudios_padre_id" required class="form-control">
                    <option value="" selected>--Seleccione--</option>
                    @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->id }}">{{ $nivel->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="nivel_estudios_madre_id">Nivel máximo de estudios alcanzado por
                    la madre (aunque haya fallecido)</label>
                <select name="nivel_estudios_madre_id" id="nivel_estudios_madre_id" required class="form-control">
                    <option value="" selected>--Seleccione--</option>
                    @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->id }}">{{ $nivel->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="habita">¿Con quién vives actualmente?<br>&nbsp;</label>
                <select name="habita" id="habita" class="form-control" required>
                    <option value="" selected>--Seleccione--</option>
                    <option value="S">Solo</option>
                    <option value="A">Padre y madre  (y hermanos de tenerlos)</option>
                    <option value="P">Solamente con el padre (y hermanos de tenerlos)</option>
                    <option value="M">Solamente con la madre  (y hermanos de tenerlos)</option>
                    <option value="H">Con algún hermano(a)</option>
                    <option value="T">Tutores (y hermanos de tenerlos)</option>
                    <option value="O">Parientes</option>
                </select>
            </div>
        </div>
        <legend>Ingresos familiares mensuales</legend>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="ingresos_padre">Ingreso del Padre</label>
                <input type="number" name="ingresos_padre" id="ingresos_padre" value="0" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="ingresos_madre">Ingreso de la madre</label>
                <input type="number" name="ingresos_madre" id="ingresos_madre" value="0" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="ingresos_hermanos">Ingreso de los Hermanos</label>
                <input type="number" name="ingresos_hermanos" id="ingresos_hermanos" value="0" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="ingresos_propios">Ingreso Propio</label>
                <input type="number" name="ingresos_propios" id="ingresos_propios" value="0" class="form-control">
            </div>
        </div>
        <legend>¿Cuál es la ocupación o trabajo de tus padres o tutores?</legend>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="ocupacion_padre_id">Por el padre</label>
                <select name="ocupacion_padre_id" id="ocupacion_padre_id" class="form-control">
                    <option value="" selected>--Seleccione--</option>
                    @foreach ($ocupaciones as $ocupacion)
                        <option value="{{ $ocupacion->id }}">{{ $ocupacion->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="ocupacion_madre_id">Por la madre</label>
                <select name="ocupacion_madre_id" id="ocupacion_madre_id" class="form-control">
                    <option value="" selected>--Seleccione--</option>
                    @foreach ($ocupaciones as $ocupacion)
                        <option value="{{ $ocupacion->id }}">{{ $ocupacion->descripcion }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <legend>En cuanto al hogar</legend>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="casa_vives">El lugar en donde vives es</label>
                <select name="casa_vives" id="casa_vives" class="form-control">
                    <option value="" selected>--Seleccione--</option>
                    <option value="P" >Propia</option>
                    <option value="R" >Rentada</option>
                    <option value="O" >Otro</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="dependencia">¿De quién dependes económicamente?</label>
                <select name="dependencia" id="dependencia" class="form-control">
                    <option value="" selected>--Seleccione--</option>
                    <option value="P">Padre</option>
                    <option value="M">Madre</option>
                    <option value="Y">De mí mismo</option>
                    <option value="T">Tutores</option>
                    <option value="O">Otros</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="cuartos_casa">¿Cuántas habitaciones tiene la casa?<br>&nbsp;</label>
                <select name="cuartos_casa" id="cuartos_casa" class="form-control">
                    <option value="1" selected>1</option>
                    @for ($i=2; $i<=9 ; $i++)
                        <option value='{{$i}}'>{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="personas_casa">¿Cuántas personas viven en la casa?<br>
                    &nbsp;</label>
                <select name="personas_casa" id="personas_casa" class="form-control">
                    <option value="1" selected>1</option>
                    @for ($i=2; $i<=9 ; $i++)
                        <option value='{{$i}}'>{{$i}}</option>
                    @endfor
                    <option value="10">Más de 10</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="personas_dependen">¿Cuántas personas incluyéndote a tí, dependen
                    económicamente del principal apoyo o sustento?</label>
                <select name="personas_dependen" id="personas_dependen" class="form-control">
                    <option value="1" selected>1</option>
                    @for ($i=2; $i<=9 ; $i++)
                        <option value='{{$i}}'>{{$i}}</option>
                    @endfor
                    <option value="10">Más de 10</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
@stop
