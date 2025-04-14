<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zona;
use App\Models\ZonaSection;
use Illuminate\Http\Request;
use Storage;

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
            'imagen_principal' => 'nullable|image|max:5120',
            'contenido_html' => 'nullable|string',
        ]);

        $zona = new Zona();
        $zona->nombre = $request->nombre;
        $zona->contenido_html = $request->contenido_html;

        if ($request->hasFile('imagen_principal')) {
            $ruta = $request->file('imagen_principal')->store('zonas', 'public');
            $zona->imagen_principal = $ruta;
        }

        $zona->save();

        // Guardar secciones
        if ($request->has('secciones')) {
            foreach ($request->secciones as $seccion) {
                $zonaSeccion = new ZonaSection();
                $zonaSeccion->zona_id = $zona->id;
                $zonaSeccion->titulo = $seccion['titulo'];
                $zonaSeccion->descripcion = $seccion['descripcion'];

                if (isset($seccion['imagen']) && $seccion['imagen'] instanceof \Illuminate\Http\UploadedFile) {
                    $ruta = $seccion['imagen']->store('zonas/secciones', 'public');
                    $zonaSeccion->imagen = $ruta;
                }

                $zonaSeccion->save();
            }
        }

        $zonas = Zona::orderBy('nombre')->get();
        return view('admin.zonas.index', compact('zonas'));
    }

    public function update(Request $request, Zona $zona)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen_principal' => 'nullable|image|max:5120',
            'contenido_html' => 'nullable|string',
        ]);

        $zona->nombre = $request->nombre;
        $zona->contenido_html = $request->contenido_html;

        if ($request->hasFile('imagen_principal')) {
            if ($zona->imagen_principal) {
                Storage::disk('public')->delete($zona->imagen_principal);
            }

            $ruta = $request->file('imagen_principal')->store('zonas', 'public');
            $zona->imagen_principal = $ruta;
        }

        $zona->save();

        $zona->secciones()->delete();

        if ($request->has('secciones')) {
            foreach ($request->secciones as $seccion) {
                $zonaSeccion = new ZonaSection();
                $zonaSeccion->zona_id = $zona->id;
                $zonaSeccion->titulo = $seccion['titulo'];
                $zonaSeccion->descripcion = $seccion['descripcion'];

                if (isset($seccion['imagen']) && $seccion['imagen'] instanceof \Illuminate\Http\UploadedFile) {
                    $ruta = $seccion['imagen']->store('zonas/secciones', 'public');
                    $zonaSeccion->imagen = $ruta;
                }

                $zonaSeccion->save();
            }
        }

        $zonas = Zona::orderBy('nombre')->get();
        return view('admin.zonas.index', compact('zonas'));
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
