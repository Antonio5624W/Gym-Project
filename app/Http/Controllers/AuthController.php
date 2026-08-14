<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar que no mande campos vacíos
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ["required"],
        ]);

        // Intentar abrir (Auth::attempt encripta la pass y compara)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Seguridad contra robo de sesión

            // --- AQUÍ ESTÁ LA MAGIA DEL REDIRECCIONAMIENTO ---
            // Revisamos qué rol tiene el usuario que acaba de iniciar sesión
            if (Auth::user()->role === 'recepcion') {
                // Si es recepcionista, lo mandamos directo a la acción (evitando el dashboard)
                return redirect()->route('clients.create');
            }

            // Si no es recepcionista (es admin), lo mandamos al panel principal normal
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
