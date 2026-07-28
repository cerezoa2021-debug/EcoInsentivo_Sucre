@extends('adminlte::page')

@section('title', 'Detalle del Centro de Acopio')

@section('content_header')
    <h1>{{ $centro->nombre }}</h1>
@endsection

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>#mapa { height: 300px; border-radius: 4px; }</style>
@vite('resources/css/app.css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Dirección</dt>
                        <dd class="col-sm-8">{{ $centro->direccion }}</dd>

                        <dt class="col-sm-4">Horario</dt>
                        <dd class="col-sm-8">{{ $centro->horario ?? '—' }}</dd>

                        <dt class="col-sm-4">Estado</dt>
                        <dd class="col-sm-8">
                            <span class="badge {{ $centro->estado ? 'badge-success' : 'badge-secondary' }}">
                                {{ $centro->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('centros-acopio.edit', $centro) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="{{ route('centros-acopio.index') }}" class="btn btn-default btn-sm">Volver</a>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body p-0">
                    <div id="mapa"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const pos = [{{ $centro->latitud }}, {{ $centro->longitud }}];

    const map = L.map('mapa').setView(pos, 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 19,
    }).addTo(map);

    L.marker(pos).addTo(map).bindPopup('{{ $centro->nombre }}').openPopup();
</script>
@endsection