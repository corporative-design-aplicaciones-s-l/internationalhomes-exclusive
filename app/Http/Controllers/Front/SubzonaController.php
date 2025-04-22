<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Subzona;

class SubzonaController extends Controller
{
    public function show($locale, $slug)
    {
        $subzona = Subzona::where('slug', $slug)->with(['zona', 'properties'])->firstOrFail();

        return view('subzonas.show', compact('subzona'));
    }
}
