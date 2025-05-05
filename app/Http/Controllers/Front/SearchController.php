<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::query();

        if ($request->filled('location')) {
            $properties->whereHas('subzona.zona', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->location . '%');
            });
        }

        if ($request->filled('type')) {
            $properties->where('tipo', $request->type); //
        }

        if ($request->filled('min_price')) {
            $properties->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $properties->where('price', '<=', $request->max_price);
        }

        $results = $properties->paginate(9);

        return view('search.results', compact('results'));
    }
}
