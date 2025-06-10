@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Carga de documentos para obtención de ficha</h1>
@stop

@section('content')
    <h4>Por favor, completa la información solicitada</h4>
    <div class="card" aria-hidden="true">
        <div class="card-body">
            <h3 class="card-title placeholder-glow">IMPORTANTE</h3><br>
            <div class="alert alert-danger" role="alert">
                En cada ocasión en la que suba documentos,
                el sistema borrará lo que previamente haya cargado
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('documentos.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Fotografía del aspirante
                        </button>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                     data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                Subir fotografía donde se visualice el rostro del aspirante (tipo
                                tamaño infantil).
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="photo" class="form-label">Subir foto</label>
                                    <input type="file" name="photo" id="photo"
                                           class="form-control-file" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingSeven">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            CURP
                        </button>
                    </h2>
                </div>
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                     data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                Clave Única de Registro Poblacional (CURP)
                                <a href="https://www.gob.mx/curp/" target="_blank">
                                    Obtener CURP
                                </a>
                                Subir la constancia escaneada en formato PDF
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="curp" class="form-label">
                                        CURP</label>
                                    <input type="file" name="curp" id="curp"
                                           class="form-control-file" accept="application/pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Certificado de estudios
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                     data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                Subir el <strong>certificado</strong> de preparatoria (NO
                                constancia de terminación de estudios) en caso de contarlo. Deberá
                                ser un documento tipo PDF escaneado en ambos lados y con un peso
                                inferior a los 1000 KB.
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="prepa" class="form-label">
                                        CERTIFICADO de preparatoria (en caso de contar con el mismo)</label>
                                    <input type="file" name="prepa" id="prepa"
                                           class="form-control-file" accept="application/pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Constancia de terminación de estudios
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                     data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                En caso de aún no contar con el certificado de preparatoria,
                                subir entonces una constancia expedida recientemente por la
                                escuela preparatoria, en donde se señale que el aspirante se
                                encuentre en 6to semestre. Subir la constancia escaneada en formato PDF
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="constancia" class="form-label">
                                        Constancia de terminación de estudios</label>
                                    <input type="file" name="constancia" id="constancia"
                                           class="form-control-file" accept="application/pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFour">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Acta de nacimiento
                        </button>
                    </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                     data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                Acta de nacimiento actualizada. Subir la constancia escaneada en formato PDF
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="acta_nacimiento" class="form-label">
                                        Acta de nacimiento actualizada</label>
                                    <input type="file" name="acta_nacimiento" id="acta_nacimiento"
                                           class="form-control-file" accept="application/pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFive">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Número de seguro social (NSS).
                        </button>
                    </h2>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                     data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                El NSS, o Número de Seguridad Social, es un identificador único y permanente que el
                                IMSS (Instituto Mexicano del Seguro Social) asigna a cada persona asegurada en México.
                                Este documento se puede obtener desde el siguiente enlace
                                <a href="https://www.imss.gob.mx/tramites/imss02008" target="_blank">
                                    Obtener NSS
                                </a>
                                <br>Subir la constancia escaneada en formato PDF
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="imss" class="form-label">
                                        NSS</label>
                                    <input type="file" name="imss" id="imss"
                                           class="form-control-file" accept="application/pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingSix">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Forma migratoria (Solamente si aplica)
                        </button>
                    </h2>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                     data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                En caso de no ser de nacionalidad mexicana (extranjero), se requiere del permiso
                                migratorio para estudiar en México. Los extranjeros que deseen permanecer en el país
                                más de 180 días, deben solicitar una visa de Residente Temporal Estudiante.
                                Esta visa es para aquellos que desean estudiar, tomar cursos o realizar proyectos de
                                investigación en una institución educativa perteneciente al Sistema Educativo Nacional.
                                Subir la constancia escaneada en formato PDF
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="forma_migratoria" class="form-label">
                                        Forma migratoria</label>
                                    <input type="file" name="forma_migratoria" id="forma_migratoria"
                                           class="form-control-file" accept="application/pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Continuar</button>
        </div>

    </form>
@stop

@section('css')
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
@stop
@section('js')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
@stop
