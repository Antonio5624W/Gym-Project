<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        //1. valimdamos los datos
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,recepcion', // Validación para el rol
        ]);

        //2. Guardamos en la base de datos(el modelo entra en acción)
        \App\Models\user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => $request->role, // Guardamos el rol
        ]);

        //3. Regresamos con el mensaje de éxito a la vista
        return redirect()->route('users.create')
            ->with('success', 'Empleado registrado exitosamente.');
    }
}
