@extends('adminlte::page')

@section('title', 'Residuos')

@section('content_header')
    <h1>Residuos</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('residuos.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Nuevo Residuo
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Puntos</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($residuos as $residuo)
                        <tr>
                            <td>{{ $residuo->nombre }}</td>
                            <td>{{ $residuo->categoria }}</td>
                            <td>{{ $residuo->puntos }}</td>
                            <td>
                                <span class="badge {{ $residuo->estado ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $residuo->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('residuos.show', $residuo) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('residuos.edit', $residuo) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('residuos.destroy', $residuo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este residuo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection