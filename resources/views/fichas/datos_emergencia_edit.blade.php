@extends('adminlte::page')

@section('title', 'Datos emergencia')

@section('content_header')
    <h1>Actualización de los datos registrados para contacto en caso de emergencia</h1>
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
    <form action="{{ route('datos_emergencia.update',['datos_emergencium' => $datos_emergencium->id]) }}" method="post" role="form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group col-md-2">
                <label for="tipo_sangre_id">Tipo de sangre</label><br>
                <select name="tipo_sangre_id" id="tipo_sangre_id" required class="form-control">
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}" {{$tipo->id==$tipo_sangre->id?"selected":""}}>{{ $tipo->tipo_sangre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-10">
                <label for="tipo_alergia">¿Presentas algún tipo de alergia?</label><br>
                <input type="text" name="tipo_alergia" id="tipo_alergia"
                       value="{{$datos_emergencium->tipo_alergia??""}}"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="enfermedad">¿Presentas alguna enfermedad que requiera consideración particular?</label>
                <input type="text" name="enfermedad" id="enfermedad"
                       value="{{$datos_emergencium->emergencia??""}}"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
        </div>
        <legend>Datos de la persona para contactar en caso de emergencia</legend>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="comunicar_con">Nombre de la persona con quien se puede
                    contactar en caso de emergencia
                </label>
                <input type="text" name="comunicar_con" id="comunicar_con" class="form-control"
                       value="{{$datos_emergencium->comunicar_con??""}}"
                       onblur="this.value=this.value.toUpperCase();">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="calle_numero">Calle y número</label>
                <input type="text" name="calle_numero" id="calle_numero" class="form-control"
                       value="{{$datos_emergencium->calle_numero??""}}"
                       onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-6">
                <label for="colonia">Colonia</label>
                <input type="text" name="colonia" id="colonia" class="form-control"
                       value="{{$datos_emergencium->colonia??""}}"
                       onblur="this.value=this.value.toUpperCase();">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="municipio">Municipio</label>
                <input type="text" name="municipio" id="municipio" class="form-control"
                       value="{{$datos_emergencium->municipio??""}}"
                       onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-6">
                <label for="telefono_contacto">Teléfono de contacto</label>
                <input type="tel" name="telefono_contacto" id="telefono_contacto" class="form-control"
                       value="{{$datos_emergencium->telefono_contacto??""}}"
                       onblur="this.value=this.value.toUpperCase();">
            </div>
        </div>
        <legend>Lugar de trabajo</legend>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="lugar_trabajo">¿Dónde trabaja la persona de contacto?</label>
                <input type="text" name="lugar_trabajo" id="lugar_trabajo" class="form-control"
                       value="{{$datos_emergencium->lugar_trabajo??""}}"
                       onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-6">
                <label for="telefono_trabajo">Teléfono del trabajo</label>
                <input type="tel" name="telefono_trabajo" id="telefono_trabajo" class="form-control"
                       value="{{$datos_emergencium->telefono_trabajo??""}}"
                       onblur="this.value=this.value.toUpperCase();">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
@stop

