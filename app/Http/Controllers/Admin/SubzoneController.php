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
        $request->validate([
            'nombre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'zona_id' => 'required|exists:zonas,id',
            'imagen_destacada' => 'nullable|image|max:5120',
            'resumen' => 'nullable|string|max:500',
            'descripcion' => 'nullable|string',
            'habitaciones' => 'nullable|integer',
            'banos' => 'nullable|integer',
            'superficie' => 'nullable|numeric',
            'precio_desde' => 'nullable|numeric',
            'estado' => 'nullable|string|max:100',
            'imagenes.*' => 'nullable|image|max:5120',
        ]);

        // Slug automático si no viene
        $slug = $request->slug ?: Str::slug($request->nombre);
        $baseSlug = $slug;
        $count = 2;

        while (Subzona::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        // Crear la subzona
        $subzona = new Subzona();
        $subzona->zona_id = $request->zona_id;
        $subzona->nombre = $request->nombre;
        $subzona->slug = $slug;
        $subzona->resumen = $request->resumen;
        $subzona->descripcion = $request->descripcion;
        $subzona->habitaciones = $request->habitaciones;
        $subzona->banos = $request->banos;
        $subzona->superficie = $request->superficie;
        $subzona->precio_desde = $request->precio_desde;
        $subzona->estado = $request->estado;

        // Imagen destacada
        if ($request->hasFile('imagen_destacada')) {
            $path = $request->file('imagen_destacada')->store('subzonas', 'public');
            $subzona->imagen_destacada = $path;
        }

        $subzona->save();

        // Galería
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $file) {
                $path = $file->store('subzonas', 'public');
                SubzonaImagen::create([
                    'subzona_id' => $subzona->id,
                    'path' => $path,
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
