@extends('adminlte::page')

@section('title', 'Nuevo Residuo')

@section('content_header')
    <h1>Nuevo Residuo</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('residuos.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                    @error('nombre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Categoría</label>
                    <input type="text" name="categoria" class="form-control @error('categoria') is-invalid @enderror" value="{{ old('categoria') }}" required>
                    @error('categoria') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="3">{{ old('descripcion') }}</textarea>
                    @error('descripcion') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Puntos</label>
                    <input type="number" name="puntos" min="0" class="form-control @error('puntos') is-invalid @enderror" value="{{ old('puntos', 0) }}" required>
                    @error('puntos') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Estado</label>
                    <select name="estado" class="form-control @error('estado') is-invalid @enderror" required>
                        <option value="1" {{ old('estado', '1') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('residuos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection