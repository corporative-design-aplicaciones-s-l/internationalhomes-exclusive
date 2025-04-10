<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:500',
        ]);

        // Aquí puedes enviar un correo o guardar en la base de datos
        // Mail::to('correo@empresa.com')->send(new ContactMail($request));

        // Retorno de mensaje de éxito
        return redirect()->back()->with('success', 'Gracias por tu mensaje. Nos pondremos en contacto pronto.');
    }
}
