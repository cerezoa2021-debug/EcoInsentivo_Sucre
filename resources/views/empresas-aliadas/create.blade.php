@extends('adminlte::page')

@section('title', 'Nuevo Negocio')

@section('content_header')
    <h1>Nuevo Negocio</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('empresas-aliadas.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                    @error('nombre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Rubro</label>
                    <input type="text" name="rubro" class="form-control" value="{{ old('rubro') }}">
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="estado" value="1" class="form-check-input" id="estado" checked>
                    <label class="form-check-label" for="estado">Activo</label>
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('empresas-aliadas.index') }}" class="btn btn-default">Cancelar</a>
            </form>
        </div>
    </div>
@endsection