<?php

namespace App\Http\Controllers;

use App\Models\Residuo;
use Illuminate\Http\Request;

class ResiduoController extends Controller
{
    /**
     * Mostrar todos los residuos.
     */
    public function index()
    {
        $residuos = Residuo::all();
        return view('residuos.index', compact('residuos'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('residuos.create');
    }

    /**
     * Guardar nuevo residuo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'puntos' => 'required|integer|min:0',
            'estado' => 'required|boolean',
        ]);

        Residuo::create($request->all());

        return redirect()->route('residuos.index')
            ->with('success', 'Residuo registrado correctamente.');
    }

    /**
     * Mostrar un residuo.
     */
    public function show(Residuo $residuo)
    {
        return view('residuos.show', compact('residuo'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Residuo $residuo)
    {
        return view('residuos.edit', compact('residuo'));
    }

    /**
     * Actualizar residuo.
     */
    public function update(Request $request, Residuo $residuo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'puntos' => 'required|integer|min:0',
            'estado' => 'required|boolean',
        ]);

        $residuo->update($request->all());

        return redirect()->route('residuos.index')
            ->with('success', 'Residuo actualizado correctamente.');
    }

    /**
     * Eliminar residuo.
     */
    public function destroy(Residuo $residuo)
    {
        $residuo->delete();

        return redirect()->route('residuos.index')
            ->with('success', 'Residuo eliminado correctamente.');
    }
}