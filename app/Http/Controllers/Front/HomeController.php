<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Property::where('is_featured', true)->take(6)->get();
        return view('welcome', compact('featured'));
    }
}
