<?php

namespace App\Http\Controllers;

use App\Models\Centro_acopio;
use Illuminate\Http\Request;

class CentroAcopioController extends Controller
{
    public function index()
    {
        $centros = Centro_acopio::conCoordenadas()->latest()->paginate(10);

        return view('centros-acopio.index', compact('centros'));
    }

    public function create()
    {
        return view('centros-acopio.create');
    }

    public function store(Request $request)
    {
        $data = $this->validarDatos($request);
        $coords = $this->extraerCoords($request);

        $centro = Centro_acopio::create($data);
        $centro->ubicacion = $coords;

        return redirect()
            ->route('centros-acopio.index')
            ->with('success', 'Centro de acopio registrado correctamente.');
    }

    public function show(Centro_acopio $centrosAcopio)
    {
        $centro = Centro_acopio::conCoordenadas()->findOrFail($centrosAcopio->id);

        return view('centros-acopio.show', compact('centro'));
    }

    public function edit(Centro_acopio $centrosAcopio)
    {
        $centro = Centro_acopio::conCoordenadas()->findOrFail($centrosAcopio->id);

        return view('centros-acopio.edit', compact('centro'));
    }

    public function update(Request $request, Centro_acopio $centrosAcopio)
    {
        $data = $this->validarDatos($request);
        $coords = $this->extraerCoords($request);

        $centrosAcopio->update($data);
        $centrosAcopio->ubicacion = $coords;

        return redirect()
            ->route('centros-acopio.index')
            ->with('success', 'Centro de acopio actualizado correctamente.');
    }

    public function destroy(Centro_acopio $centrosAcopio)
    {
        $centrosAcopio->delete();

        return redirect()
            ->route('centros-acopio.index')
            ->with('success', 'Centro de acopio eliminado correctamente.');
    }

    // Endpoint JSON que consume el mapa (AdminLTE + Google Maps JS)
    public function mapaData()
    {
        $centros = Centro_acopio::conCoordenadas()
            ->where('estado', true)
            ->get();

        return response()->json($centros->map(fn ($c) => [
            'id'        => $c->id,
            'nombre'    => $c->nombre,
            'direccion' => $c->direccion,
            'horario'   => $c->horario,
            'lat'       => (float) $c->latitud,
            'lng'       => (float) $c->longitud,
        ]));
    }

    private function validarDatos(Request $request): array
    {
        return $request->validate([
            'nombre'    => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'horario'   => ['nullable', 'string', 'max:255'],
            'estado'    => ['sometimes', 'boolean'],
        ]);
    }

    private function extraerCoords(Request $request): array
    {
        $request->validate([
            'latitud'  => ['required', 'numeric', 'between:-90,90'],
            'longitud' => ['required', 'numeric', 'between:-180,180'],
        ]);

        return ['lat' => $request->latitud, 'lng' => $request->longitud];
    }
}