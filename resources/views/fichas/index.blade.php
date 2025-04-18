@extends('adminlte::page')

@section('title', 'Solicitud de ficha')

@section('content_header')
    <h1>Registro de aspirantes</h1>
@stop

@section('content')
    @if($bandera==1)
        <h2>Bienvenido</h2>
        <p>Por favor, termina de realizar el registro de la solicitud de la ficha ingresando
            dentro de "Captura" en el menú lateral izquierdo.
            El sistema te permitirá realizar la impresión de la ficha de depósito solamente
            hasta que se haya terminado éste proceso. Una vez realizado el pago en el banco,
            entrega una copia del mismo al Departamento de Desarrollo Académico
        </p>
        <h4>Número de ficha {{session('ficha')}}</h4>
    @else
        <h2>Período fuera de tiempo</h2>
        <p>Por el momento, el período de solicitud de ficha ha sido cerrado</p>
    @endif
@stop

