@extends('adminlte::page')

@section('title', 'Detalle del Residuo')

@section('content_header')
    <h1>{{ $residuo->nombre }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('residuos.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('residuos.edit', $residuo) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
        <div class="card-body">
            <table class="table table-borderless w-auto">
                <tr>
                    <th>Categoría:</th>
                    <td>{{ $residuo->categoria }}</td>
                </tr>
                <tr>
                    <th>Descripción:</th>
                    <td>{{ $residuo->descripcion ?? 'No especificada' }}</td>
                </tr>
                <tr>
                    <th>Puntos:</th>
                    <td>{{ $residuo->puntos }}</td>
                </tr>
                <tr>
                    <th>Estado:</th>
                    <td>
                        <span class="badge {{ $residuo->estado ? 'badge-success' : 'badge-secondary' }}">
                            {{ $residuo->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection