<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subzona;
use App\Models\SubzonaImagen;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

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
        $request->validate([
            'nombre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'zona_id' => 'required|exists:zonas,id',
            'imagen_destacada' => 'nullable|image|max:5120',
            'plano' => 'nullable|image|max:5120',
            'pdf_info_comercial' => 'nullable|mimes:pdf|max:10000',
            'imagenes.*' => 'nullable|image|max:5120',
        ]);

        $subzona->update([
            'nombre' => $request->nombre,
            'slug' => $request->slug ?? Str::slug($request->nombre),
            'zona_id' => $request->zona_id,
            'resumen' => $request->resumen,
            'descripcion' => $request->descripcion,
            'habitaciones' => $request->habitaciones,
            'banos' => $request->banos,
            'superficie' => $request->superficie,
            'precio_desde' => $request->precio_desde,
            'estado' => $request->estado,
            'fecha_entrega' => $request->fecha_entrega,
            'ventajas' => $request->ventajas,
            'equipamiento' => $request->equipamiento,
        ]);

        // Imagen destacada
        if ($request->hasFile('imagen_destacada')) {
            $path = $request->file('imagen_destacada')->store('subzonas', 'public');
            $subzona->imagen_destacada = $path;
        }

        // Plano
        if ($request->hasFile('plano')) {
            $path = $request->file('plano')->store('subzonas/planos', 'public');
            $subzona->plano = $path;
        }

        // PDF
        if ($request->hasFile('pdf_info_comercial')) {
            $path = $request->file('pdf_info_comercial')->store('subzonas/pdfs', 'public');
            $subzona->pdf_info_comercial = $path;
        }

        $subzona->save();

        // Imágenes de galería
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $img) {
                $path = $img->store('subzonas/galeria', 'public');

                $subzona->imagenes()->create([
                    'path' => $path,
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
