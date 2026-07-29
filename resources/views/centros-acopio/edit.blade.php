@extends('adminlte::page')

@section('title', 'Editar Centro de Acopio')

@section('content_header')
    <h1>Editar Centro de Acopio</h1>
@endsection

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #mapa { height: 350px; border-radius: 4px; }
    #sugerencias { position: relative; z-index: 1000; }
    #sugerencias .list-group-item { cursor: pointer; }
</style>
@vite('resources/css/app.css')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('centros-acopio.update', $centro) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $centro->nombre) }}" required>
                    @error('nombre') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion', $centro->direccion) }}" required autocomplete="off" placeholder="Escribe y espera las sugerencias, o haz clic en el mapa">
                    @error('direccion') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    <div id="sugerencias" class="list-group"></div>
                </div>

                <div class="form-group">
                    <label>Horario</label>
                    <input type="text" name="horario" class="form-control" value="{{ old('horario', $centro->horario) }}" placeholder="Lun-Vie 08:00-17:00">
                </div>

                <input type="hidden" name="latitud" id="latitud" value="{{ old('latitud', $centro->latitud) }}">
                <input type="hidden" name="longitud" id="longitud" value="{{ old('longitud', $centro->longitud) }}">

                <div id="mapa" class="mb-3"></div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="estado" value="1" class="form-check-input" id="estado" {{ old('estado', $centro->estado) ? 'checked' : '' }}>
                    <label class="form-check-label" for="estado">Activo</label>
                </div>

                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('centros-acopio.index') }}" class="btn btn-default">Cancelar</a>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const posInicial = [
        parseFloat(document.getElementById('latitud').value),
        parseFloat(document.getElementById('longitud').value)
    ];

    const map = L.map('mapa').setView(posInicial, 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 19,
    }).addTo(map);

    const marker = L.marker(posInicial, { draggable: true }).addTo(map);

    function actualizarCoords(lat, lng) {
        document.getElementById('latitud').value = lat;
        document.getElementById('longitud').value = lng;
    }

    marker.on('dragend', () => {
        const pos = marker.getLatLng();
        actualizarCoords(pos.lat, pos.lng);
    });

    map.on('click', (e) => {
        marker.setLatLng(e.latlng);
        actualizarCoords(e.latlng.lat, e.latlng.lng);
    });

    const inputDireccion = document.getElementById('direccion');
    const contSugerencias = document.getElementById('sugerencias');
    let timeoutBusqueda;

    inputDireccion.addEventListener('input', () => {
        clearTimeout(timeoutBusqueda);
        const q = inputDireccion.value.trim();

        if (q.length < 3) {
            contSugerencias.innerHTML = '';
            return;
        }

        timeoutBusqueda = setTimeout(() => buscarDireccion(q), 500);
    });

    function buscarDireccion(q) {
        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(q + ', Sucre, Bolivia')}&limit=5`;

        fetch(url, { headers: { 'Accept-Language': 'es' } })
            .then(res => res.json())
            .then(resultados => {
                contSugerencias.innerHTML = '';

                resultados.forEach(r => {
                    const item = document.createElement('button');
                    item.type = 'button';
                    item.className = 'list-group-item list-group-item-action';
                    item.textContent = r.display_name;

                    item.addEventListener('click', () => {
                        inputDireccion.value = r.display_name;
                        contSugerencias.innerHTML = '';

                        const lat = parseFloat(r.lat);
                        const lng = parseFloat(r.lon);

                        map.setView([lat, lng], 16);
                        marker.setLatLng([lat, lng]);
                        actualizarCoords(lat, lng);
                    });

                    contSugerencias.appendChild(item);
                });
            });
    }
</script>
@endsection