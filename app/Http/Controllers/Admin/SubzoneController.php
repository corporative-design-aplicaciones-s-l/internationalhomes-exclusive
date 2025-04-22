<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subzona;
use App\Models\SubzonaImagen;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubzoneController extends Controller
{
    public function index()
    {
        $subzonas = Subzona::with('zona')->get();
        return view('admin.subzonas.index', compact('subzonas'));
    }

    public function create()
    {
        $zonas = Zona::all();
        return view('admin.subzonas.create', compact('zonas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'slug' => 'required|string|unique:subzonas',
            'zona_id' => 'required|exists:zonas,id',
            'descripcion' => 'nullable|string',
            'imagen_principal' => 'nullable|image',
        ]);

        if ($request->hasFile('imagen_principal')) {
            $data['imagen_principal'] = $request->file('imagen_principal')->store('subzonas', 'public');
        }

        $subzona = Subzona::create($data);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $img) {
                $subzona->imagenes()->create([
                    'path' => $img->store('subzonas', 'public'),
                ]);
            }
        }

        return redirect()->route('admin.subzonas.index')->with('success', 'Subzona creada correctamente.');
    }

    public function edit(Subzona $subzona)
    {
        $zonas = Zona::all();
        return view('admin.subzonas.edit', compact('subzona', 'zonas'));
    }

    public function update(Request $request, Subzona $subzona)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'slug' => 'required|string|unique:subzonas,slug,' . $subzona->id,
            'zona_id' => 'required|exists:zonas,id',
            'descripcion' => 'nullable|string',
            'imagen_principal' => 'nullable|image',
        ]);

        if ($request->hasFile('imagen_principal')) {
            // Elimina la anterior si existe
            if ($subzona->imagen_principal && Storage::disk('public')->exists($subzona->imagen_principal)) {
                Storage::disk('public')->delete($subzona->imagen_principal);
            }

            $data['imagen_principal'] = $request->file('imagen_principal')->store('subzonas', 'public');
        }

        $subzona->update($data);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $img) {
                $subzona->imagenes()->create([
                    'path' => $img->store('subzonas', 'public'),
                ]);
            }
        }

        return redirect()->route('admin.subzonas.index')->with('success', 'Subzona actualizada correctamente.');
    }

    public function destroy(Subzona $subzona)
    {
        // Borra imágenes de la galería asociadas
        foreach ($subzona->imagenes as $imagen) {
            Storage::disk('public')->delete($imagen->path);
            $imagen->delete();
        }

        // Borra imagen destacada si existe
        if ($subzona->imagen_principal && Storage::disk('public')->exists($subzona->imagen_principal)) {
            Storage::disk('public')->delete($subzona->imagen_principal);
        }

        $subzona->delete();

        return redirect()->route('admin.subzonas.index')->with('success', 'Subzona eliminada correctamente.');
    }
}
