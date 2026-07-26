<?php

namespace App\Http\Controllers;

use App\Models\Registro_reciclaje;
use App\Models\Billetera;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PuntosController extends Controller
{
    public function index()
    {
        $pendientes = Registro_reciclaje::with(['usuario', 'residuo', 'centroAcopio'])
            ->where('estado', 'pendiente')
            ->orderBy('fecha')
            ->paginate(15);

        return view('puntos.index', compact('pendientes'));
    }

    public function confirmar(Registro_reciclaje $registro)
    {
        if ($registro->estado !== 'pendiente') {
            return back()->with('error', 'Este registro ya fue procesado.');
        }

        DB::transaction(function () use ($registro) {
            // lockForUpdate evita condiciones de carrera si dos confirmaciones
            // llegan casi al mismo tiempo para el mismo usuario.
            $billetera = Billetera::where('user_id', $registro->user_id)
                ->lockForUpdate()
                ->first();

            if (! $billetera) {
                $billetera = Billetera::create([
                    'user_id' => $registro->user_id,
                    'saldo_puntos' => 0,
                ]);
            }

            $billetera->increment('saldo_puntos', $registro->puntos_generados);
            $billetera->forceFill(['fecha_actualizacion' => now()])->save();

            $registro->estado = 'confirmado';
            $registro->save();
        });

        return back()->with('success', 'Puntos acreditados correctamente.');
    }

    public function ajustar(Request $request, User $usuario)
    {
        $data = $request->validate([
            'cantidad' => ['required', 'integer', 'min:1'],
            'tipo'     => ['required', Rule::in(['sumar', 'restar'])],
            'motivo'   => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($data, $usuario) {
            $billetera = Billetera::where('user_id', $usuario->id)
                ->lockForUpdate()
                ->first();

            if (! $billetera) {
                $billetera = Billetera::create([
                    'user_id' => $usuario->id,
                    'saldo_puntos' => 0,
                ]);
                $billetera = Billetera::where('user_id', $usuario->id)->lockForUpdate()->first();
            }

            if ($data['tipo'] === 'restar' && $billetera->saldo_puntos < $data['cantidad']) {
                abort(422, 'Saldo insuficiente para descontar esa cantidad.');
            }

            $data['tipo'] === 'sumar'
                ? $billetera->increment('saldo_puntos', $data['cantidad'])
                : $billetera->decrement('saldo_puntos', $data['cantidad']);

            $billetera->forceFill(['fecha_actualizacion' => now()])->save();
        });

        return back()->with('success', 'Saldo de puntos actualizado.');
    }
}