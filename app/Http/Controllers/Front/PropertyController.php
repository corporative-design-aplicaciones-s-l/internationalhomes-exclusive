<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::query();

        // Filtro: tipo
        if ($request->filled('tipo')) {
            $properties->whereIn('tipo', $request->input('tipo'));
        }

        // Filtro: zona
        if ($request->filled('zona')) {
            $properties->whereIn('zona_id', $request->input('zona'));
        }

        // Filtro: precio mínimo y máximo
        if ($request->filled('precio_min')) {
            $properties->where('price', '>=', $request->input('precio_min'));
        }

        if ($request->filled('precio_max')) {
            $properties->where('price', '<=', $request->input('precio_max'));
        }

        // Filtro: habitaciones mínimas
        if ($request->filled('habitaciones')) {
            $properties->where('habitaciones', '>=', $request->input('habitaciones'));
        }

        // Filtro: baños mínimos
        if ($request->filled('banos')) {
            $properties->where('banos', '>=', $request->input('banos'));
        }

        // Filtro: superficie construida mínima
        if ($request->filled('metros')) {
            $properties->where('metros', '>=', $request->input('metros'));
        }

        // Filtro: solar, patio, piscina
        if ($request->boolean('tiene_solar')) {
            $properties->where('tiene_solar', true);
        }

        if ($request->boolean('tiene_patio')) {
            $properties->where('tiene_patio', true);
        }

        if ($request->boolean('tiene_piscina')) {
            $properties->where('tiene_piscina', true);
        }

        // Paginación
        $properties = $properties->with('zona')->paginate(12)->withQueryString();

        return view('properties.index', compact('properties'));
    }

    public function show($slug)
    {
        $property = Property::where('slug', $slug)->with('images')->firstOrFail();
        return view('properties.show', compact('property'));
    }
}
