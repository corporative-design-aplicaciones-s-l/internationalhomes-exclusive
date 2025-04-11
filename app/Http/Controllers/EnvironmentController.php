<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;
use Str;

class EnvironmentController extends Controller
{
    public function index()
    {
        $zonas = Zona::select('nombre', 'imagen_principal')->get();

        return view('environment.index', compact('zonas'));
    }

    public function show($slug)
{
    $zona = Zona::all()->first(fn($zona) => Str::slug($zona->nombre) === $slug);

    abort_unless($zona, 404);

    $zona->load('secciones');

    return view('environment.show', compact('zona'));
}


}
