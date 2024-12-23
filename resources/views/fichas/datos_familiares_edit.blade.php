@extends('adminlte::page')

@section('title', 'Datos familiares')

@section('content_header')
    <h1>Actualización del registro de datos familiares</h1>
@stop

@section('content')
        <form action="{{route('datos_familiares.update',['datos_familiare'=>$datos_familiare->id])}}" method="post" role="form">
        @csrf
        @method('PUT')
        <legend>Datos del padre o tutor</legend>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="apellido_paterno_padre">Apellido Paterno Padre</label>
                <input type="text" name="apellido_paterno_padre" id="apellido_paterno_padre"
                       value="{{$datos_familiare->apellido_paterno_padre}}"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="apellido_materno_padre">Apellido Materno Padre</label>
                <input type="text" name="apellido_materno_padre" id="apellido_materno_padre"
                       value="{{$datos_familiare->apellido_materno_padre}}"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="nombre_padre">Nombre Padre</label>
                <input type="text" name="nombre_padre" id="nombre_padre"
                       value="{{$datos_familiare->nombre_padre}}"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="vive_padre">¿Aún vive?</label>
                <select name="vive_padre" id="vive_padre" class="form-control">
                    <option value="true" {{$bandera1==1?"selected":""}}>Sí vive</option>
                    <option value="false" {{$bandera1==0?"selected":""}}>No vive</option>
                </select>
            </div>
        </div>
        <legend>Datos de la madre o tutora</legend>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="apellido_paterno_madre">Apellido Paterno Madre</label>
                <input type="text" name="apellido_paterno_madre" id="apellido_paterno_madre"
                       value="{{$datos_familiare->apellido_paterno_madre}}"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="apellido_materno_madre">Apellido Materno Madre</label>
                <input type="text" name="apellido_materno_madre" id="apellido_materno_madre"
                       value="{{$datos_familiare->apellido_materno_madre}}"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="nombre_madre">Nombre Madre</label>
                <input type="text" name="nombre_madre" id="nombre_madre"
                       value="{{$datos_familiare->nombre_madre}}"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="vive_madre">¿Aún vive?</label>
                <select name="vive_madre" id="vive_madre" class="form-control">
                    <option value="true" {{$bandera2==1?"selected":""}}>Sí vive</option>
                    <option value="false" {{$bandera2==0?"selected":""}}>No vive</option>
                </select>
            </div>
        </div>
        <legend>Situación actual</legend>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="estado_civil">Estado Civil</label>
                <select name="estado_civil" id="estado_civil" class="form-control">
                    <option value="S" {{$datos_familiare->estado_civil=="S"?" selected":""}}>Soltero(a)</option>
                    <option value="C" {{$datos_familiare->estado_civil=="C"?" selected":""}} >Casado(a)</option>
                    <option value="D" {{$datos_familiare->estado_civil=="D"?" selected":""}} >Divorciado(a)</option>
                    <option value="U" {{$datos_familiare->estado_civil=="U"?" selected":""}} >Unión Libre</option>
                    <option value="V" {{$datos_familiare->estado_civil=="V"?" selected":""}} >Viudo(a)</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="beca">¿Cuenta con Beca?</label>
                <select name="beca" id="beca" class="form-control">
                    <option value="false" {{$bandera3==0?"selected":""}}>No</option>
                    <option value="true" {{$bandera3==1?"selected":""}} >Sí</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="zona_procedencia">Zona de procedencia</label>
                <select name="zona_procedencia" id="zona_procedencia" class="form-control">
                    <option value="U" {{$datos_familiare->zona_procedencia=="U"?" selected":""}}>Urbano</option>
                    <option value="I" {{$datos_familiare->zona_procedencia=="I"?" selected":""}}>Indígena</option>
                    <option value="R" {{$datos_familiare->zona_procedencia=="R"?" selected":""}}>Rural</option>
                    <option value="M" {{$datos_familiare->zona_procedencia=="M"?" selected":""}}>Urbano Marginado</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="capacidad_diferente">En caso de contar con alguna capacidad diferente,
                favor de indicarla</label>
                <input type="text" name="capacidad_diferente" id="capacidad_diferente"
                       value="{{$datos_familiare->capacidad_diferente}}"
                       class="form-control" onchange="this.value=this.value.toUpperCase();">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
@stop
