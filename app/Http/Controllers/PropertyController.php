<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Propietario;
use App\Models\Zona;
use Illuminate\Http\Request;
use Str;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%$search%")
                ->orWhere('location', 'like', "%$search%")
                ->orWhere('reference', 'like', "%$search%");
        }

        $properties = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return view('admin.properties._table', compact('properties'))->render();
        }

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $zonas = Zona::all();
        $propietarios = Propietario::all();

        return view('admin.properties.create', compact('zonas', 'propietarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string',
            'price' => 'nullable|numeric',
            'tipo' => 'nullable|string|max:100',
            'zona_id' => 'nullable|exists:zonas,id',
            'propietario_id' => 'nullable|exists:propietarios,id',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_fr' => 'nullable|string',
            'description_de' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'banos' => 'nullable|integer',
            'habitaciones' => 'nullable|integer',
            'metros' => 'nullable|integer',
            'tiene_solar' => 'nullable|boolean',
            'metros_solar' => 'nullable|integer',
            'tiene_patio' => 'nullable|boolean',
            'tiene_piscina' => 'nullable|boolean',
            'images.*' => 'nullable|image|max:5120', // 5MB por imagen
        ]);

        // Crear propiedad
        $property = Property::create([
            'title' => $request->title,
            'location' => $request->location,
            'price' => $request->price,
            'tipo' => $request->tipo,
            'zona_id' => $request->zona_id,
            'propietario_id' => $request->propietario_id,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'description_fr' => $request->description_fr,
            'description_de' => $request->description_de,
            'description_ru' => $request->description_ru,
            'bathrooms' => $request->banos,
            'bedrooms' => $request->habitaciones,
            'area' => $request->metros,
            'tiene_solar' => $request->has('tiene_solar'),
            'metros_solar' => $request->metros_solar,
            'tiene_patio' => $request->has('tiene_patio'),
            'tiene_piscina' => $request->has('tiene_piscina'),
        ]);

        // Generar slug único
        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;
        $count = 2;
        while (Property::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }
        $property->slug = $slug;

        // Generar ref tipo R-[id]
        $property->ref = 'R-' . $property->id;

        // Procesar imágenes
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $index => $image) {
                $path = $image->store('properties', 'public');

                if ($index === 0) {
                    $property->thumbnail = $path;
                } else {
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'path' => $path,
                    ]);
                }
            }
        }

        $property->save();

        return redirect()->route('admin.properties.index')
            ->with('success', 'Propiedad creada correctamente.');
    }



    public function edit($id)
    {
        $zonas = Zona::all();
        $propietarios = Propietario::all();

        $property = Property::findOrFail($id);
        return view('admin.properties.edit', compact('property', 'zonas', 'propietarios'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            // Otros campos según sea necesario
        ]);

        $property->update($request->all());
        return redirect()->route('admin.properties.index')->with('success', 'Propiedad actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Propiedad eliminada exitosamente.');
    }
}
