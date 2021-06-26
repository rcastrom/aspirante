@extends('layout')

@section('menu')
    <h1>
        Inicio
        <small>Solicitud de pre-ficha</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Inicio</li>
    </ol>
@endsection

@section('content')

    @if( auth()->check() )
        @if($bandera==1)
        <h2>Bienvenido</h2>
            <p>Por favor, termina de realizar el registro de la solicitud de la ficha ingresando 
                dentro de "Captura" en el menú lateral izquierdo.
            El sistema te permitirá realizar la impresión de la ficha de depósito solamente
            hasta que se haya terminado éste proceso. Una vez realizado el pago en el banco,  entrega una copia del mismo al Departamento de Desarrollo Académico
            
           </p>
        @else
        <h2>Período fuera de tiempo</h2>
        <p>Por el momento, el período de solicitud de ficha ha sido cerrado</p>
        @endif
    @endif

@endsection
