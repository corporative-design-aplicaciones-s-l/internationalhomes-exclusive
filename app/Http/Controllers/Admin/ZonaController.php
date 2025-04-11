<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zona;
use Illuminate\Http\Request;

class ZonaController extends Controller
{
    public function index()
    {
        $zonas = Zona::orderBy('nombre')->get();
        return view('admin.zonas.index', compact('zonas'));
    }

    public function create()
    {
        return view('admin.zonas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $zona = Zona::create($request->only('nombre'));

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.zonas._row', compact('zona'))->render()
            ]);
        }

        return redirect()->route('admin.zonas.index')->with('success', 'Zona creada correctamente.');
    }

    public function update(Request $request, Zona $zona)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $zona->update($request->only('nombre'));

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.zonas._row', compact('zona'))->render()
            ]);
        }

        return back()->with('success', 'Zona actualizada correctamente.');
    }

    public function edit(Zona $zona)
    {
        return view('admin.zonas.edit', compact('zona'));
    }

    public function destroy(Zona $zona)
    {
        $zona->delete();

        return back()->with('success', 'Zona eliminada.');
    }
}
