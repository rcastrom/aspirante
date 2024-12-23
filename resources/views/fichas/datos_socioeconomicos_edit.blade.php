@extends('adminlte::page')

@section('title', 'Datos socioeconómicos')

@section('content_header')
    <h1>Actualización del registro de datos socioeconómicos</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('datos_socioeconomicos.update',['datos_socioeconomico' => $datos_socioeconomico->id]) }}"
          method="post" role="form">
        @csrf
        @method('PUT')
        <legend>Datos SocioEconómicos</legend>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="nivel_estudios_padre_id">Nivel máximo de estudios alcanzado por
                    el padre (aunque haya fallecido)</label>
                <select name="nivel_estudios_padre_id" id="nivel_estudios_padre_id" required class="form-control">
                    @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->id }}" {{$nivel->id==$nivel_padre->id?" selected":""}}>
                            {{ $nivel->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="nivel_estudios_madre_id">Nivel máximo de estudios alcanzado por
                    la madre (aunque haya fallecido)</label>
                <select name="nivel_estudios_madre_id" id="nivel_estudios_madre_id" required class="form-control">
                    @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->id }}" {{$nivel->id==$nivel_madre->id?" selected":""}}>
                            {{ $nivel->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="habita">¿Con quién vives actualmente?<br>&nbsp;</label>
                <select name="habita" id="habita" class="form-control" required>
                    <option value="S" {{$datos_socioeconomico->habita=="S"?" selected":""}}>
                        Solo</option>
                    <option value="A" {{$datos_socioeconomico->habita=="A"?" selected":""}}>
                        Padre y madre  (y hermanos de tenerlos)</option>
                    <option value="P" {{$datos_socioeconomico->habita=="P"?" selected":""}}>
                        Solamente con el padre (y hermanos de tenerlos)</option>
                    <option value="M" {{$datos_socioeconomico->habita=="M"?" selected":""}}>
                        Solamente con la madre  (y hermanos de tenerlos)</option>
                    <option value="H" {{$datos_socioeconomico->habita=="H"?" selected":""}}>
                        Con algún hermano(a)</option>
                    <option value="T" {{$datos_socioeconomico->habita=="T"?" selected":""}}>
                        Tutores (y hermanos de tenerlos)</option>
                    <option value="O" {{$datos_socioeconomico->habita=="O"?" selected":""}}>
                        Parientes</option>
                </select>
            </div>
        </div>
        <legend>Ingresos familiares mensuales</legend>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="ingresos_padre">Ingreso del Padre</label>
                <input type="number" name="ingresos_padre" id="ingresos_padre"
                       value="{{$datos_socioeconomico->ingresos_padre}}" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="ingresos_madre">Ingreso de la madre</label>
                <input type="number" name="ingresos_madre" id="ingresos_madre"
                       value="{{$datos_socioeconomico->ingresos_madre}}" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="ingresos_hermanos">Ingreso de los Hermanos</label>
                <input type="number" name="ingresos_hermanos" id="ingresos_hermanos"
                       value="{{$datos_socioeconomico->ingresos_hermanos}}" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="ingresos_propios">Ingreso Propio</label>
                <input type="number" name="ingresos_propios" id="ingresos_propios"
                       value="{{$datos_socioeconomico->ingresos_propios}}" class="form-control">
            </div>
        </div>
        <legend>¿Cuál es la ocupación o trabajo de tus padres o tutores?</legend>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="ocupacion_padre_id">Por el padre</label>
                <select name="ocupacion_padre_id" id="ocupacion_padre_id" class="form-control">
                    @if(!isset($ocupacion_padre))
                        <option value="" selected>--Seleccione--</option>
                    @endif
                    @foreach ($ocupaciones as $ocupacion)
                        <option value="{{ $ocupacion->id }}" {{isset($ocupacion_padre)?($ocupacion->id==$ocupacion_padre->id?" selected":""):""}}>
                            {{ $ocupacion->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="ocupacion_madre_id">Por la madre</label>
                @if(!isset($ocupacion_madre))
                    <option value="" selected>--Seleccione--</option>
                @endif
                <select name="ocupacion_madre_id" id="ocupacion_madre_id" class="form-control">
                    <option value="" selected>--Seleccione--</option>
                    @foreach ($ocupaciones as $ocupacion)
                        <option value="{{ $ocupacion->id }}" {{isset($ocupacion_madre)?($ocupacion->id==$ocupacion_madre->id?" selected":""):""}}>
                            {{ $ocupacion->descripcion }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <legend>En cuanto al hogar</legend>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="casa_vives">El lugar en donde vives es</label>
                <select name="casa_vives" id="casa_vives" class="form-control">
                    <option value="P" {{$datos_socioeconomico->casa_vives=="P"?"selected":""}}>Propia</option>
                    <option value="R" {{$datos_socioeconomico->casa_vives=="R"?"selected":""}}>Rentada</option>
                    <option value="O" {{$datos_socioeconomico->casa_vives=="O"?"selected":""}}>Otro</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="dependencia">¿De quién dependes económicamente?</label>
                <select name="dependencia" id="dependencia" class="form-control">
                    <option value="P" {{$datos_socioeconomico->dependencia=="P"?"selected":""}}>Padre</option>
                    <option value="M" {{$datos_socioeconomico->dependencia=="M"?"selected":""}}>Madre</option>
                    <option value="Y" {{$datos_socioeconomico->dependencia=="Y"?"selected":""}}>De mí mismo</option>
                    <option value="T" {{$datos_socioeconomico->dependencia=="T"?"selected":""}}>Tutores</option>
                    <option value="O" {{$datos_socioeconomico->dependencia=="O"?"selected":""}}>Otros</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="cuartos_casa">¿Cuántas habitaciones tiene la casa?<br>&nbsp;</label>
                <select name="cuartos_casa" id="cuartos_casa" class="form-control">
                    @for ($i=1; $i<=9 ; $i++)
                        <option value='{{$i}}' {{$datos_socioeconomico->cuartos_casa==$i?" selected":""}}>
                            {{$i}}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="personas_casa">¿Cuántas personas viven en la casa?<br>
                    &nbsp;</label>
                <select name="personas_casa" id="personas_casa" class="form-control">
                    @for ($i=1; $i<=9 ; $i++)
                        <option value='{{$i}}' {{$datos_socioeconomico->personas_casa==$i?" selected":""}}>
                            {{$i}}
                        </option>
                    @endfor
                    <option value="10">Más de 10</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="personas_dependen">¿Cuántas personas incluyéndote a tí, dependen
                    económicamente del principal apoyo o sustento?</label>
                <select name="personas_dependen" id="personas_dependen" class="form-control">
                    @for ($i=1; $i<=9 ; $i++)
                        <option value='{{$i}}' {{$datos_socioeconomico->personas_dependen==$i?" selected":""}}>
                            {{$i}}
                        </option>
                    @endfor
                    <option value="10">Más de 10</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
@stop
