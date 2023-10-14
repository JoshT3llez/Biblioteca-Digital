@extends('portafolio.layout')
@section('content')
<div class="card" style="margin: 20px;">
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="card-header">Subir archivo</div>
    <div class="card-body">

      <form action="{{ url('portafolio') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <label>Nombre</label></br>
        <input type="text" name="nombre" title="añada el nombre del archivo" id="nombre" class="form-control" required></br>
        <label>descripcion</label></br>
        <input type="text" name="descripcion" title="añada su descripcion" id="descripcion" class="form-control" required></br>
        <label>ubicacion</label></br>
        <input placeholder="Ejemplo:  ARC-1-A-01" type="text" title="se requieren mayusculas" name="ubicacion" value="{{ old ('ubicacion')}}" id="ubicacion" class="form-control" required max="6" min="6" oninput="this.value = this.value.toUpperCase();"></br>
        <input class="form-control" name="pdf" title="escoja su archivo PDF" type="file" id="pdf" required accept=".pdf">
        <br><input type="submit" value="Guardar" title="guardar" class="btn btn-success"></br>
    </form>
  </div>
</div>
@stop
