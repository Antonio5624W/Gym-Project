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
        //validar que no mande campos vacios
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ["required"],
        ]);

        // Intentar abrir (Auth::attempt encripta la pass y compara)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Seguridad contra robo de sesión

            // Si pasa, lo mandamos DIRECTO al Panel Principal sin importar el historial
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
