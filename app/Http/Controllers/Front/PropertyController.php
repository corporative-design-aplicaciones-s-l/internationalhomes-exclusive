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

        if ($request->filled('features')) {
            $properties->whereHas('features', function ($query) use ($request) {
                $query->whereIn('name', $request->features);
            });
        }

        if ($request->filled('state')) {
            $properties->where('state', $request->state);
        }

        // Filtros por vistas, habitaciones, etc.
        if ($request->filled('views')) {
            $properties->where('views', $request->views);
        }

        if ($request->filled('bedrooms')) {
            $properties->where('bedrooms', '>=', $request->bedrooms);
        }

        if ($request->filled('bathrooms')) {
            $properties->where('bathrooms', '>=', $request->bathrooms);
        }

        // Paginación
        $properties = $properties->paginate(12)->withQueryString();

        return view('properties.index', compact('properties'));
    }
    public function show($slug)
    {
        $property = Property::where('slug', $slug)->with('images')->firstOrFail();
        return view('properties.show', compact('property'));
    }
}
