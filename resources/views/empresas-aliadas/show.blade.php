@extends('adminlte::page')

@section('css')
    @vite('resources/css/app.css')
@stop

@section('title', 'Detalle del Negocio')

@section('content_header')
    <h1>{{ $empresa->nombre }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Dirección</dt>
                        <dd class="col-sm-8">{{ $empresa->direccion ?? '—' }}</dd>

                        <dt class="col-sm-4">Teléfono</dt>
                        <dd class="col-sm-8">{{ $empresa->telefono ?? '—' }}</dd>

                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ $empresa->email ?? '—' }}</dd>

                        <dt class="col-sm-4">Rubro</dt>
                        <dd class="col-sm-8">{{ $empresa->rubro ?? '—' }}</dd>

                        <dt class="col-sm-4">Estado</dt>
                        <dd class="col-sm-8">
                            <span class="badge {{ $empresa->estado ? 'badge-success' : 'badge-secondary' }}">
                                {{ $empresa->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('empresas-aliadas.edit', $empresa) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="{{ route('empresas-aliadas.index') }}" class="btn btn-default btn-sm">Volver</a>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Beneficios ofrecidos</h3>
                </div>
                <div class="card-body p-0">
                    @if ($empresa->beneficios->isEmpty())
                        <p class="text-muted p-3 mb-0">Este negocio aún no tiene beneficios registrados.</p>
                    @else
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Puntos req.</th>
                                    <th>Vigencia</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($empresa->beneficios as $beneficio)
                                    <tr>
                                        <td>{{ $beneficio->nombre }}</td>
                                        <td>{{ $beneficio->puntos_requeridos }}</td>
                                        <td>{{ $beneficio->fecha_inicio->format('d/m/Y') }} - {{ $beneficio->fecha_fin->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge {{ $beneficio->estado ? 'badge-success' : 'badge-secondary' }}">
                                                {{ $beneficio->estado ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection