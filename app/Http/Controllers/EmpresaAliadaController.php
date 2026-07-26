<?php

namespace App\Http\Controllers;

use App\Models\Empresa_aliada;
use Illuminate\Http\Request;

class EmpresaAliadaController extends Controller
{
    public function index()
    {
        $empresas = Empresa_aliada::latest()->paginate(10);

        return view('empresas-aliadas.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresas-aliadas.create');
    }

    public function store(Request $request)
    {
        $data = $this->validarDatos($request);

        Empresa_aliada::create($data);

        return redirect()
            ->route('empresas-aliadas.index')
            ->with('success', 'Negocio registrado correctamente.');
    }

    public function show(Empresa_aliada $empresasAliada)
    {
        $empresasAliada->load('beneficios');

        return view('empresas-aliadas.show', ['empresa' => $empresasAliada]);
    }

    public function edit(Empresa_aliada $empresasAliada)
    {
        return view('empresas-aliadas.edit', ['empresa' => $empresasAliada]);
    }

    public function update(Request $request, Empresa_aliada $empresasAliada)
    {
        $data = $this->validarDatos($request);

        $empresasAliada->update($data);

        return redirect()
            ->route('empresas-aliadas.index')
            ->with('success', 'Negocio actualizado correctamente.');
    }

    public function destroy(Empresa_aliada $empresasAliada)
    {
        // OJO: beneficios de esta empresa tienen cascadeOnDelete en la FK,
        // eliminar el negocio borra también sus beneficios asociados.
        $empresasAliada->delete();

        return redirect()
            ->route('empresas-aliadas.index')
            ->with('success', 'Negocio eliminado correctamente.');
    }

    private function validarDatos(Request $request): array
    {
        return $request->validate([
            'nombre'    => ['required', 'string', 'max:255'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'telefono'  => ['nullable', 'string', 'max:20'],
            'email'     => ['nullable', 'email', 'max:255'],
            'rubro'     => ['nullable', 'string', 'max:100'],
            'estado'    => ['sometimes', 'boolean'],
        ]);
    }
}