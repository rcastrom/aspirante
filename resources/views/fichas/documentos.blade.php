@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Carga de documentos para obtención de ficha</h1>
@stop

@section('content')
    <h4>Por favor, completa la información solicitada</h4>
    <p>Esta sección, es para que se suban los documentos necesarios tanto
        para el proceso de selección.</p>
    <p>La información que se solicitará es la siguiente:
    <ul>
        <li>Una foto</li>
        <li>Acta de nacimiento actualizada</li>
        <li>Comprobante del CURP</li>
        <li>Número de seguridad social</li>
        <li>Certificado de preparatoria; o bien, constancia de terminación
        de estudios (un documento que ampare que estés en 6to semestre
        de preparatoria o que el certificado está en trámite)</li>
        <li>En caso de ser extranjero, la forma migratoria que te permita
        estudiar en México</li>
    </ul>
    <p>
        <strong>Ningún documento puede pesar más de {{$maxMB}} Mb o no podrá ser subido al sistema</strong>
    </p>
    <p>
        Cuando hayas cargado al menos los documentos solicitados deberás de
        acudir al Departamento de Servicios Escolares junto con una copia del
        depósito realizado por el concepto de ficha; así, se validará que la
        documentación que cargaste en éste espacio es correcta.
    </p>
    <p>
        Podrás acceder a esta sección cuantas ocasiones sean necesarias a fin
        de llevar a cabo la carga de documentos correspondientes.
        <strong>SIN EMBARGO</strong>, el sistema eliminará lo que previamente haya subido
    </p>
    <p>
        <a href="{{route('documentos.create')}}">Ir a la sección correspondiente</a>
    </p>
@stop
