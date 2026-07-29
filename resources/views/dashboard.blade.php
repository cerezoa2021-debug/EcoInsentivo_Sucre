@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('css')
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-ring" style="--ring-color: #AE7A51; --ring-pct: 70;">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-number">{{ number_format($totalPuntos) }}</div>
                    <div class="stat-label">Puntos otorgados</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-ring" style="--ring-color: #8CB89F; --ring-pct: 55;">
                    <i class="fas fa-recycle"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-number">{{ number_format($totalReciclado) }}</div>
                    <div class="stat-label">Residuos reciclados</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-ring" style="--ring-color: #A5CFE3; --ring-pct: 40;">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-number">{{ $centrosActivos }}</div>
                    <div class="stat-label">Centros activos</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-ring" style="--ring-color: #002211; --ring-pct: 85;">
                    <i class="fas fa-store"></i>
                </div>
                <div class="stat-body">
                    <div class="stat-number">{{ $negociosActivos }}</div>
                    <div class="stat-label">Negocios aliados</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Reciclaje confirmado esta semana</h3>
                </div>
                <div class="card-body">
                    <canvas id="graficoReciclaje" height="90"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Últimos registros</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            @forelse ($ultimosRegistros as $registro)
                                <tr>
                                    <td>
                                        <div>{{ $registro->usuario->nombre }}</div>
                                        <small class="text-muted">{{ $registro->residuo->nombre }} · {{ $registro->cantidad }}</small>
                                    </td>
                                    <td class="text-right">
                                        <span class="badge badge-success">+{{ $registro->puntos_generados }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td class="text-center text-muted p-3">Sin actividad reciente.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mi historial de reciclaje</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            @forelse ($misRegistros as $registro)
                                <tr>
                                    <td>
                                        <div>{{ $registro->residuo->nombre }}</div>
                                        <small class="text-muted">{{ $registro->centroAcopio->nombre }} · {{ $registro->cantidad }}</small>
                                    </td>
                                    <td class="text-right">
                                        <span class="badge {{ $registro->estado === 'confirmado' ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $registro->estado === 'confirmado' ? '+'.$registro->puntos_generados : 'Pendiente' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td class="text-center text-muted p-3">Aún no tienes registros de reciclaje.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    const ctx = document.getElementById('graficoReciclaje');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labelsSemana) !!},
            datasets: [{
                label: 'Cantidad reciclada',
                data: {!! json_encode($datosSemana) !!},
                borderColor: '#AE7A51',
                backgroundColor: 'rgba(174, 122, 81, 0.1)',
                tension: 0.35,
                fill: true,
                pointBackgroundColor: '#8CB89F',
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@stop