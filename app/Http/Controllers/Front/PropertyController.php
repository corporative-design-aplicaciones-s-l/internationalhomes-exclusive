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

        $recentIds = json_decode(request()->cookie('recent_properties', '[]'), true);
        $favIds = explode(',', request()->cookie('favorites', ''));

        $recentProperties = collect();
        if (!empty($recentIds)) {
            $recentProperties = Property::whereIn('id', $recentIds)->get()->keyBy('id');
            $recentProperties = collect($recentIds)->map(fn($id) => $recentProperties[$id] ?? null)->filter();
        }

        $favProperties = collect();
        if (!empty($favIds)) {
            $favProperties = Property::whereIn('id', $favIds)->get();
        }

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

        return view('properties.index', compact('properties', 'recentProperties', 'favProperties'));
    }

    public function show($slug)
    {
        $property = Property::where('slug', $slug)->with('images')->firstOrFail();
        $recent = json_decode(request()->cookie('recent_properties', '[]'), true);
        $recent = array_filter($recent, fn($id) => $id !== $property->id);
        array_unshift($recent, $property->id);
        $recent = array_slice($recent, 0, 3);

        cookie()->queue(cookie('recent_properties', json_encode($recent), 43200));

        return view('properties.show', compact('property'));
    }

    public function favoritos()
    {
        $favIds = explode(',', request()->cookie('favorites', ''));
        // dd(request()->cookie());

        $favorites = Property::whereIn('id', $favIds)->get();

        return view('properties.favorites', compact('favorites'));
    }

}
