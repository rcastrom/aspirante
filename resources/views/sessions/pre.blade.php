<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Solicitud de registro nuevo ingreso ITE</title>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {!! NoCaptcha::renderJs('es-419',true,'recaptchaCallback') !!}
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="hm-gradient2">
<!-- Begin page content -->
<main>
    <div class="container mt-6">
        <div class="row">
            <div class="col-md-10 mb-4">
                <div class="card-body">
                    <h2 class="card-title">Paso 1</h2>
                    <h3 class="card-header">Por favor, atender a las siguientes indicaciones</h3>
                    <p>El Tecnológico Nacional de México Campus Instituto Tecnológico de Ensenada, agradece tu interés
                    en formar parte de la Institución Pública que forma más ingenieros en México. Para poder obtener tu ficha
                    para el período 2021-1 (enero - junio 2021), es necesario que cuentes con un correo electrónico QUE ÉSTA
                    ESCUELA TE PROPORCIONARÁ COMO ASPIRANTE de forma gratuita.</p>
                    <p>Es decir, la solicitud de la ficha así como cualquier trámite que realices con nosotros,
                        DEBERÁN SER REALIZADOS ÚNICAMENTE mediante la cuenta de correo que se te proporcionará,
                        y para eso es éste pre-registro.</p>
                    <ol>
                        <li>Llena el formulario que se te indica a continuación.</li>
                        <li>24 HORAS DESPUÉS (salvo los registros creados en sábado y domingo, que deberán esperar hasta el
                        lunes) les llegará un correo con la información correspondiente de cuál será la cuenta que deberán usar.</li>
                        <li>En el mismo correo, les llegará el enlace donde podrán oficializar su ficha; es decir, contar con el correo NO
                        te convierte en aspirante.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="/preformato">
        @csrf
        <div class="row">
            <div class="col-md-10 mb-4">
                <div class="card blue form-white">
                    <div class="card-body">
                        <h3 class="text-center white-text py-3"><i class="fa fa-file"></i> Pre-registro:</h3>
                        <div class="md-form">
                            <i class="fa fa-user prefix white-text"></i>
                            <input type="text" id="nombre" name="nombre" class="form-control">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-user prefix white-text"></i>
                            <input type="text" id="appat" name="appat" class="form-control">
                            <label for="appat">Apellidos</label>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-user prefix white-text"></i>
                            <input type="text" id="curp" name="curp" class="form-control">
                            <label for="curp">CURP</label>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-envelope prefix white-text"></i>
                            <input type="email" id="email" name="email" class="form-control">
                            <label for="email">Correo de contacto</label>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-outline-white waves-effect waves-light">Continuar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
