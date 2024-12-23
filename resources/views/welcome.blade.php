<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Registro de aspirante | ITE</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
        <!-- Styles / Scripts -->
        <link href="{{ asset('css/coming-soon.css') }}" rel="stylesheet">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
<body>
    <div class="overlay"></div>
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="{{ asset('mp4/bg.mp4') }}" type="video/mp4">
    </video>
    <div class="masthead">
        <div class="masthead-bg">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 my-auto">
                        <div class="masthead-content text-white py-5 py-md-0">
                            <h1 class="mb-3">Instituto Tecnológico de Ensenada</h1>
                            <p class="mb-5">Módulo de pre-registro y consulta, para todos aquellos egresados de educación
                            media superior que deseen ingresar al ITE
                            </p>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('login') }}"><i class="fa fa-user">Ingresar</i></a>
                                </li>
                                <li class="nav-item">
                                    <a href={{ route('register') }}><i class="fas fa-ad">Obtener ficha</i></a>
                                </li>
                            <!--<li class="nav-item">
                                <a href="/register"><i class="fas fa-user-circle">Crear cuenta de usuario</a></i>
                            </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="social-icons">
        <ul class="list-unstyled text-center mb-0">
            <li class="list-unstyled-item">
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
            <li class="list-unstyled-item">
                <a href="#">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
            <li class="list-unstyled-item">
                <a href="#">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        </ul>
    </div>
    <script src="{{ asset('js/coming-soon.js') }}"></script>
</body>
</html>
