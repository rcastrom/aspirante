@extends('adminlte::page')

@section('title', 'Datos personales')

@section('content_header')
    <h1>Registro de datos personales</h1>
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
    <form action="{{route('datos_personales.store')}}" method="post" role="form">
        @csrf
        <legend>Datos generales</legend>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" id="apellido_paterno"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-4">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" id="apellido_materno"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-4">
                <label for="nombre_aspirante">Nombre</label>
                <input type="text" name="nombre_aspirante" id="nombre_aspirante"
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required
                       class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="sexo">Sexo</label>
                <select name="sexo" id="sexo" class="form-control" required>
                    <option value="" selected>--Seleccione--</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="pais">País de nacimiento</label>
                <select name="pais" id="pais" class="form-control">
                    @foreach ($paises as $pais)
                        <option value="{{ $pais->id }}" {{trim($pais->codigo)=="MEX"?"selected":""}}>{{$pais->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="estado_nacimiento">Estado de nacimiento (en caso de ser mexicano)</label>
                <select name="estado_nacimiento" id="estado_nacimiento" class="form-control" required>
                    <option value="" selected>--Seleccione--</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->estado_id }}">{{$estado->estado}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="municipio_nacimiento">Municipio de nacimiento (en caso de ser mexicano)</label>
                <select name="municipio_nacimiento" id="municipio_nacimiento" class="form-control" required></select>
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="etnia">Comunidad Indígena (si aplica)</label>
                <select name="etnia" id="etnia" class="form-control">
                    <option value="" selected>--Seleccione--</option>
                    @foreach ($etnias as $etnia)
                        <option value="{{$etnia->id}}">{{ $etnia->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="curp">CURP</label>
                <input type="text" name="curp" id="curp" maxlength="18" size="18" required
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-4">
                <label for="carrera">Carrera a ingresar</label>
                <select name="carrera" id="carrera" class="form-control" required>
                    <option value="" selected>--Seleccione--</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{$carrera->carrera}}">{{$carrera->nombre_carrera}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <legend>Domicilio actual</legend>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="calle_numero">Calle y Numero</label>
                <input type="text" name="calle_numero" id="calle_numero" required
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-4">
                <label for="colonia">Colonia</label>
                <input type="text" name="colonia" id="colonia" required
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
            <div class="form-group col-md-4">
                <label for="codigo_postal">Código Postal</label>
                <input type="text" name="codigo_postal" id="codigo_postal" maxlength="5" required
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="entidad_federativa">Entidad Federativa</label>
                <select name="entidad_federativa" id="entidad_federativa" class="form-control" required>
                    <option value="" selected>--Seleccione--</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->estado_id }}">{{$estado->estado}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="municipio">Municipio</label>
                <select name="municipio" id="municipio" class="form-control" required></select>
            </div>
            <div class="form-group col-md-3">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" required
                       class="form-control" onblur="this.value=this.value.toUpperCase();">
            </div>
        </div>
        <legend>Medios de contacto</legend>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="correo">Correo electrónico</label>
                <input type="email" name="correo" id="correo" required
                       class="form-control" onblur="this.value=this.value.toLowerCase();">
            </div>
            <div class="form-group col-md-4">
                <label for="fb">Facebook</label>
                <input type="text" name="fb" id="fb"
                       class="form-control" onblur="this.value=this.value.toLowerCase();">
            </div>
            <div class="form-group col-md-4">
                <label for="ig">Instagram</label>
                <input type="text" name="ig" id="ig"
                       class="form-control" onblur="this.value=this.value.toLowerCase();">
            </div>
        </div>
        <div class="row">
            <div class="col">
                Indica por favor tus redes sociales solamente si pueden servir como un
                medio de contacto.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
@stop
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function (){
            $(document).on('change','#estado_nacimiento',function (){
                let estado=$(this).val();
                $('#municipio_nacimiento').show();
                $.ajax({
                    method:'POST',
                    url:"{{route('municipios')}}",
                    data:{
                        estado: estado
                    },
                    success: function (res){
                        if(res.status==='success'){
                            let all_options="<option value=''>Seleccione</option>";
                            let all_municipios=res.municipios;
                            $.each(all_municipios, function(index,value){
                                all_options+="<option value='"+value.id+"'>"+value.municipio+"</option>";
                            });
                            $("#municipio_nacimiento").html(all_options);
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function (){
            $(document).on('change','#entidad_federativa',function (){
               let estado=$(this).val();
               $('#municipio').show();
               $.ajax({
                   method:'POST',
                   url:"{{route('municipios')}}",
                   data:{
                       estado: estado
                   },
                   success: function (res){
                       if(res.status==='success'){
                           let all_options="<option value=''>Seleccione</option>";
                           let all_municipios=res.municipios;
                           $.each(all_municipios, function(index,value){
                              all_options+="<option value='"+value.id+"'>"+value.municipio+"</option>";
                           });
                           $("#municipio").html(all_options);
                       }
                   }
               });
            });
        });
    </script>
@stop
