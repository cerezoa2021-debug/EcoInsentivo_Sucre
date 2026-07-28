@extends('adminlte::page')

@section('title', 'Centros de Acopio')

@section('content_header')
    <h1>Centros de Acopio</h1>
@endsection

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>#mapaGeneral { height: 400px; }</style>
@vite('resources/css/app.css')
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-3">
        <div class="card-body p-0">
            <div id="mapaGeneral"></div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('centros-acopio.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Nuevo centro
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Horario</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($centros as $centro)
                        <tr>
                            <td>{{ $centro->nombre }}</td>
                            <td>{{ $centro->direccion }}</td>
                            <td>{{ $centro->horario }}</td>
                            <td>
                                <span class="badge {{ $centro->estado ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $centro->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('centros-acopio.edit', $centro) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('centros-acopio.destroy', $centro) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este centro?');">
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
        <div class="card-footer">{{ $centros->links() }}</div>
    </div>
@endsection

@section('js')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('mapaGeneral').setView([-19.0333, -65.2627], 13); // Sucre

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 19,
    }).addTo(map);

    fetch('{{ route('centros-acopio.mapa-data') }}')
        .then(res => res.json())
        .then(centros => {
            centros.forEach(c => {
                L.marker([c.lat, c.lng])
                    .addTo(map)
                    .bindPopup(`<strong>${c.nombre}</strong><br>${c.direccion}<br><small>${c.horario ?? ''}</small>`);
            });
        });
</script>
@endsection