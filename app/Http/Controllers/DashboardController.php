<?php

namespace App\Http\Controllers;

use App\Models\Billetera;
use App\Models\Centro_acopio;
use App\Models\Empresa_aliada;
use App\Models\Registro_reciclaje;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $inicioSemana = Carbon::now()->startOfWeek();

        $totalPuntos = Billetera::sum('saldo_puntos');

        $totalReciclado = Registro_reciclaje::where('estado', 'confirmado')
            ->where('fecha', '>=', $inicioMes)
            ->sum('cantidad');

        $centrosActivos = Centro_acopio::where('estado', true)->count();

        $negociosActivos = Empresa_aliada::where('estado', true)->count();

        $ultimosRegistros = Registro_reciclaje::with(['usuario', 'residuo'])
            ->latest('fecha')
            ->take(5)
            ->get();

        // Reciclado confirmado por día, de lunes a hoy de esta semana
        $registrosSemana = Registro_reciclaje::where('estado', 'confirmado')
            ->where('fecha', '>=', $inicioSemana)
            ->selectRaw("to_char(fecha, 'ID') as dia_iso, SUM(cantidad) as total")
            ->groupBy('dia_iso')
            ->pluck('total', 'dia_iso');

        $nombresDias = ['1' => 'Lun', '2' => 'Mar', '3' => 'Mié', '4' => 'Jue', '5' => 'Vie', '6' => 'Sáb', '7' => 'Dom'];
        $labelsSemana = array_values($nombresDias);
        $datosSemana = collect($nombresDias)->keys()->map(fn ($dia) => (float) ($registrosSemana[$dia] ?? 0))->toArray();

        return view('dashboard', compact(
            'totalPuntos',
            'totalReciclado',
            'centrosActivos',
            'negociosActivos',
            'ultimosRegistros',
            'labelsSemana',
            'datosSemana',
        ));
    }
}