<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Propietario;
use App\Models\Subzona;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%$search%")
                ->orWhere('location', 'like', "%$search%")
                ->orWhere('ref', 'like', "%$search%");
        }

        $properties = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return view('admin.properties._table', compact('properties'))->render();
        }

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $subzonas = Subzona::all();
        $propietarios = Propietario::all();

        return view('admin.properties.create', compact('subzonas', 'propietarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string',
            'price' => 'nullable|numeric',
            'tipo' => 'nullable|string|max:100',
            'subzona_id' => 'nullable|exists:subzonas,id',
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
            'destacada' => 'nullable|boolean',
            'tiene_piscina' => 'nullable|boolean',
            'images.*' => 'nullable|image|max:5120',
        ]);



        $property = Property::create([
            'title' => $request->title,
            'location' => $request->location,
            'price' => $request->price,
            'tipo' => $request->tipo,
            'subzona_id' => $request->subzona_id,
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
            'is_featured' => $request->has('destacada'),
            'tiene_piscina' => $request->has('tiene_piscina'),
        ]);

        // Slug único
        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;
        $count = 2;
        while (Property::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }
        $property->slug = $slug;

        // Referencia tipo R-[id]
        $property->ref = "R-{$property->id}";

        // Guardar imágenes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('properties', 'public');

                if ($index === 0) {
                    $property->thumbnail = $path;
                } else {
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'url' => "storage/$path",
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
        $subzonas = Subzona::all();
        $propietarios = Propietario::all();

        $property = Property::with('images')->findOrFail($id);

        return view('admin.properties.edit', compact('subzonas', 'property'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string',
            'price' => 'nullable|numeric',
            'tipo' => 'nullable|string|max:100',
            'subzona_id' => 'nullable|exists:subzonas,id',
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
            'destacada' => 'nullable|boolean',
            'tiene_piscina' => 'nullable|boolean',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $property->update([
            'title' => $request->title,
            'location' => $request->location,
            'price' => $request->price,
            'tipo' => $request->tipo,
            'subzona_id' => $request->subzona_id,
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
            'is_featured' => $request->has('destacada'),
            'tiene_piscina' => $request->has('tiene_piscina'),
        ]);

        // Procesar nuevas imágenes si se suben
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('properties', 'public');

                // Si no hay thumbnail aún o se reemplaza
                if ($index === 0 && !$property->thumbnail) {
                    $property->thumbnail = $path;
                } else {
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'url' => "storage/$path",
                        'path' => $path,
                    ]);
                }
            }

            if (!$property->slug) {
                $baseSlug = Str::slug($request->title);
                $slug = $baseSlug;
                $count = 2;
                while (Property::where('slug', $slug)->where('id', '!=', $property->id)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                $property->slug = $slug;
            }

            $property->save();
        }

        return redirect()->route('admin.properties.index')
            ->with('success', 'Propiedad actualizada correctamente.');
    }


    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return redirect()->route('admin.properties.index')
            ->with('success', 'Propiedad eliminada exitosamente.');
    }
}
