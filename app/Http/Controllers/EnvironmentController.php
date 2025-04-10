<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnvironmentController extends Controller
{
    public function index()
    {
        $locations = [
            'Calpe' => '/images/calpe.jpg',
            'Benissa' => '/images/benissa.jpg',
            'Moraira' => '/images/moraira.jpg',
            'Jávea' => '/images/javea.jpg',
            'Dénia' => '/images/denia.jpg',
            'Altea' => '/images/altea.jpg',
            'Benidorm' => '/images/benidorm.jpg',
            'Villajoyosa' => '/images/villajoyosa.jpg',
            'Alicante' => '/images/alicante.jpg',
            'Valencia' => '/images/valencia.jpg',
            'Valle de Jalón' => '/images/valle-jalon.jpg',
        ];

        return view('environment.index', compact('locations'));
    }

}
