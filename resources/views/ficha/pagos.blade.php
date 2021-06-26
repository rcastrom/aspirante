@extends('layout')

@section('menu')
<h1>
    Impresión
    <small>Ficha de depósito</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-print"></i>Imprimir</a></li>
    <li class="active">Pagos</li>
</ol>
@endsection

@section('content')
    <form action="recibos.pdf.php" method="post" role="form">
        @csrf
        <legend>Generador de recibos de pagos</legend>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="tpago">Indique el recibo que desea imprimir</label>
                <select name="tpago" id="tpago" required class="form-control">
		    <option value="" selected>--Seleccione--</option>
		    @foreach ($datos as $key)
			<option value="{{ $key->clave }}">{{ $key->descripcion }}</option>
		    @endforeach
                </select>
            </div>
        </div>
        <input type="hidden" name="periodo" value="{{ $periodo }}">
        <input type="hidden" name="pre" value="{{ $id }}">
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
@endsection
