<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function show($slug)
    {
        $property = Property::where('slug', $slug)->with('images')->firstOrFail();
        return view('properties.show', compact('property'));
    }
}
