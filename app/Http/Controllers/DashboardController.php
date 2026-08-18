<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription; 
use Carbon\Carbon;           
use Barryvdh\DomPDF\Facade\Pdf;

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

    // 1. Exportar el Corte Diario
    public function exportDaily()
    {
        $pagos = Subscription::with(['client', 'plan'])->whereDate('created_at', Carbon::today())->get();
        $total = $pagos->sum('price');
        $titulo = "Corte Diario - " . Carbon::today()->format('d/m/Y');

        $pdf = Pdf::loadView('reports.pdf', compact('pagos', 'total', 'titulo'));
        return $pdf->stream('corte_diario.pdf'); // 'stream' abre el PDF en el navegador
    }

    // 2. Exportar la Semana Actual
    public function exportWeekly()
    {
        $inicioSemana = Carbon::now()->startOfWeek();
        $finSemana = Carbon::now()->endOfWeek();
        
        $pagos = Subscription::with(['client', 'plan'])->whereBetween('created_at', [$inicioSemana, $finSemana])->get();
        $total = $pagos->sum('price');
        $titulo = "Reporte Semanal: " . $inicioSemana->format('d/m/Y') . " al " . $finSemana->format('d/m/Y');

        $pdf = Pdf::loadView('reports.pdf', compact('pagos', 'total', 'titulo'));
        return $pdf->stream('reporte_semanal.pdf');
    }

    // 3. Exportar el Mes Actual
    public function exportMonthly()
    {
        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year;

        $pagos = Subscription::with(['client', 'plan'])
                    ->whereMonth('created_at', $mesActual)
                    ->whereYear('created_at', $anioActual)->get();
        $total = $pagos->sum('price');
        $titulo = "Reporte Mensual - Mes: " . $mesActual . " del " . $anioActual;

        $pdf = Pdf::loadView('reports.pdf', compact('pagos', 'total', 'titulo'));
        return $pdf->stream('reporte_mensual.pdf');
    }
}