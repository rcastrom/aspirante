@extends('adminlte::page')

@section('title', 'Datos familiares')

@section('content_header')
    <h1>Registro de datos familiares</h1>
@stop

@section('content')
    <h4>Por favor, completa la información solicitada</h4>

    <form action="{{route('datos_familiares.store')}}" method="post" role="form">
        @csrf
        <legend>Datos del padre o tutor</legend>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="apellido_paterno_padre">Apellido Paterno Padre</label>
                <input type="text" name="apellido_paterno_padre" id="apellido_paterno_padre"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="apellido_materno_padre">Apellido Materno Padre</label>
                <input type="text" name="apellido_materno_padre" id="apellido_materno_padre"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="nombre_padre">Nombre Padre</label>
                <input type="text" name="nombre_padre" id="nombre_padre"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="vive_padre">¿Aún vive?</label>
                <select name="vive_padre" id="vive_padre" class="form-control" required>
                    <option value="" selected>--Indique</option>
                    <option value="true">Sí vive</option>
                    <option value="false">No vive</option>
                </select>
            </div>
        </div>
        <legend>Datos de la madre o tutora</legend>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="apellido_paterno_madre">Apellido Paterno Madre</label>
                <input type="text" name="apellido_paterno_madre" id="apellido_paterno_madre"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="apellido_materno_madre">Apellido Materno Madre</label>
                <input type="text" name="apellido_materno_madre" id="apellido_materno_madre"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="nombre_madre">Nombre Madre</label>
                <input type="text" name="nombre_madre" id="nombre_madre"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-3">
                <label for="vive_madre">¿Aún vive?</label>
                <select name="vive_madre" id="vive_madre" class="form-control" required>
                    <option value="" selected>--Indique</option>
                    <option value="true">Sí vive</option>
                    <option value="false">No vive</option>
                </select>
            </div>
        </div>
        <legend>Situación actual</legend>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="estado_civil">Estado Civil</label>
                <select name="estado_civil" id="estado_civil" class="form-control">
                    <option value="S" selected>Soltero(a)</option>
                    <option value="C" >Casado(a)</option>
                    <option value="D" >Divorciado(a)</option>
                    <option value="U" >Unión Libre</option>
                    <option value="V" >Viudo(a)</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="beca">¿Cuenta con Beca?</label>
                <select name="beca" id="beca" class="form-control">
                    <option value="false" selected>No</option>
                    <option value="true" >Sí</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="zona_procedencia">Zona de procedencia</label>
                <select name="zona_procedencia" id="zona_procedencia" class="form-control">
                    <option value="U" selected>Urbano</option>
                    <option value="I" >Indígena</option>
                    <option value="R" >Rural</option>
                    <option value="M" >Urbano Marginado</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="capacidad_diferente">En caso de contar con alguna capacidad diferente,
                favor de indicarla</label>
                <input type="text" name="capacidad_diferente" id="capacidad_diferente"
                       class="form-control" onchange="this.value=this.value.toUpperCase();">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
@stop
