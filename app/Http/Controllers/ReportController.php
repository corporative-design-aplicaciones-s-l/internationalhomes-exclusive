<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Aquí puedes generar reportes
        return view('admin.reports.index');
    }
}
