@extends('portafolio.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12" style="padding:20px;">
             <div class="card">
                <h4> Bienvenido, {{ Auth::user()->name }}</h4>
                    <table class="card-header">
                        <thead>
                            <th class="thb"><h5>Biblioteca Digital</h5></th>
                            <th class="thn"></th>
                            <th class="thb"></th>
                            <th><h5></h5></th>
                            <th><form method="GET" action="{{ route('welcome.index') }}">
                        <label for="cantidad">Mostrar:</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="cantidad" id="cantidad" onchange="this.form.submit()">
                            <option selected>Opciones</option>
                            <option value="10" {{ Request::get('cantidad') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ Request::get('cantidad') == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ Request::get('cantidad') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </form>
                </th>
                <th>
                    <form action="{{ route('logout') }}" method="POST" role="search">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger" type="submit">Logout</button>
                    </form>
                </th>
                <th><a href="{{ url('register') }}" class="btn btn-outline-warning">
                    <i class="fa fa-plus" aria-hidden="true"></i> Registrar personal
                </a>
            </th>
                    </thead>
                    </table>
                    <form method="GET" action="{{ route('welcome.index') }}">
                        <div class="input-group mb-3">
                            <input type="text" name="search_value" value="{{ $search_value }}" placeholder="Buscar por nombre/ubicacion" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i>Buscar</button>
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        <a href="{{ url('/portafolio/create') }}" class="btn btn-outline-success btn-sm" title="subir archivo">
                            <i class="fa fa-plus" aria-hidden="true"></i> Subir Archivo
                        </a>
                        <br/>
                        <br/>
                        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Ubicacion</th>
                                        <th>.PDF</th>
                                        <th>Eliminar</th>
                                </thead>
                                </thead>
                                <tbody>
                                @foreach($file as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        <td>{{ $item->descripcion }}</td>
                                        <td>{{ $item->ubicacion }}</td>
                                        <td>
                                            <a href="{{ asset('storage/pdf/2087358986.pdf') }}" target="_blank">Ver PDF</a>
                                           <img src="{{URL::asset('img/pngwing.com.png')}}" width="50" height="50">
                                        </a>
                                        </td>
                                        <td>
                                            <form action="{{route('portafolio.destroy',$item->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $file->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
