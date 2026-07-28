@extends('adminlte::page')

@section('css')
    @vite('resources/css/app.css')
@stop

@section('title', 'Gestión de Puntos')

@section('content_header')
    <h1>Gestión de Puntos</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Registros de reciclaje pendientes de confirmar</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Residuo</th>
                        <th>Centro</th>
                        <th>Cantidad</th>
                        <th>Puntos</th>
                        <th>Fecha</th>
                        <th class="text-right">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendientes as $registro)
                        <tr>
                            <td>{{ $registro->usuario->nombre }} {{ $registro->usuario->apellido }}</td>
                            <td>{{ $registro->residuo->nombre }}</td>
                            <td>{{ $registro->centroAcopio->nombre }}</td>
                            <td>{{ $registro->cantidad }}</td>
                            <td>{{ $registro->puntos_generados }}</td>
                            <td>{{ $registro->fecha->format('d/m/Y H:i') }}</td>
                            <td class="text-right">
                                <form action="{{ route('puntos.confirmar', $registro) }}" method="POST" onsubmit="return confirm('¿Confirmar y acreditar estos puntos?');">
                                    @csrf
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i> Confirmar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">No hay registros pendientes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $pendientes->links() }}</div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Ajuste manual de saldo</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('/puntos/ajustar') }}" method="POST" id="formAjuste">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>ID de usuario</label>
                        <input type="number" name="usuario_id" id="usuario_id" class="form-control" required>
                        <small class="form-text text-muted">Reemplázalo por un select cuando tengas listado de usuarios.</small>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Tipo</label>
                        <select name="tipo" class="form-control">
                            <option value="sumar">Sumar</option>
                            <option value="restar">Restar</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" min="1" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Motivo</label>
                        <input type="text" name="motivo" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Aplicar ajuste</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script>
    // El id de ruta es dinámico (por usuario), así que armamos el action en JS
    document.getElementById('formAjuste').addEventListener('submit', function () {
        const id = document.getElementById('usuario_id').value;
        this.action = `/puntos/ajustar/${id}`;
    });
</script>
@endsection