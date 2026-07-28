@extends('adminlte::page')

@section('css')
    @vite('resources/css/app.css')
@stop

@section('title', 'Negocios Aliados')

@section('content_header')
    <h1>Negocios Aliados</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('empresas-aliadas.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Nuevo negocio
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Rubro</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                        <tr>
                            <td>{{ $empresa->nombre }}</td>
                            <td>{{ $empresa->rubro }}</td>
                            <td>{{ $empresa->telefono }}</td>
                            <td>{{ $empresa->email }}</td>
                            <td>
                                <span class="badge {{ $empresa->estado ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $empresa->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('empresas-aliadas.show', $empresa) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('empresas-aliadas.edit', $empresa) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('empresas-aliadas.destroy', $empresa) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este negocio? También se eliminarán sus beneficios.');">
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
        <div class="card-footer">
            {{ $empresas->links() }}
        </div>
    </div>
@endsection