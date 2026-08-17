<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription; 
use Carbon\Carbon;           

class DashboardController extends Controller
{
    // Esta solo dibuja tus 3 opciones principales
    public function index()
    {
        return view('dashboard');
    }

    // Esta es la pantalla nueva de los dineros
    public function reports()
    {
        $hoy = Carbon::today();
        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year;

        $ingresosHoy = Subscription::whereDate('created_at', $hoy)->sum('price');
        $ingresosMes = Subscription::whereMonth('created_at', $mesActual)
                                   ->whereYear('created_at', $anioActual)
                                   ->sum('price');
        $ventasMes = Subscription::whereMonth('created_at', $mesActual)
                                 ->whereYear('created_at', $anioActual)
                                 ->count();

        return view('reports.index', compact('ingresosHoy', 'ingresosMes', 'ventasMes'));
    }
}