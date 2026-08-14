<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Client;
use App\Models\Plan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function create()
    {
        $clients = Client::all();
        $plans = Plan::all();

        return view('subscriptions.create', compact('clients', 'plans'));
    }

public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'plan_id' => 'required'
        ]);

        $plan = Plan::find($request->plan_id);

        $fechaInicio = Carbon::now();
        
        // Condición inteligente: Si el plan es de 1 día, caduca hoy a la medianoche.
        // Si es de más días (como la mensualidad), se suman los días normales.
        if ($plan->duration_days <= 1) {
            $fechaFin = Carbon::today()->endOfDay(); // Genera: 2026-08-13 23:59:59
        } else {
            $fechaFin = Carbon::now()->addDays($plan->duration_days);
        }

        Subscription::create([
            'client_id' => $request->client_id,
            'plan_id' => $plan->id,
            'start_date' => $fechaInicio,
            'end_date' => $fechaFin,
            'price' => $plan->price
        ]);

        // Cambiamos el formato de salida a 'd-m-Y H:i' para ver la hora en pantalla
        return redirect()->route('subscriptions.create')
            ->with('success', '¡Pago registrado! El cliente tiene acceso hasta el ' . $fechaFin->format('d-m-Y') . ' a las ' . $fechaFin->format('H:i'));
    }
}
