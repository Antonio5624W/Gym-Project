<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // 1. Mostrar el formulario (Pantalla)
    public function create()
    {
        return view('clients.create');
    }

    // 2. Guardar el socio en la base de datos (Lógica)
    public function store(Request $request)
    {
        // Validamos que no nos manden datos vacíos
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        // Creamos el cliente usando el Modelo
        Client::create($request->all());

        // Redirigimos al usuario con un mensaje de éxito
        return redirect()->route('clients.create')->with('success', '¡Cliente registrado correctamente!');
    }
}