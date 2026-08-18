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

        // --- EL GUARDIA DE SEGURIDAD ---
        $suscripcionActiva = Subscription::where('client_id', $request->client_id)
            ->where('end_date', '>=', Carbon::now())
            ->first();

        if ($suscripcionActiva) {
            $fecha = Carbon::parse($suscripcionActiva->end_date);
            // Separamos el texto "a las" fuera de la función format()
            $fechaVencimiento = $fecha->format('d/m/Y') . ' a las ' . $fecha->format('H:i');
            
            return redirect()->back()
                ->with('error', '❌ Alto ahí: Este usuario ya cuenta con una membresía activa (' . $suscripcionActiva->plan->name . ') válida hasta el ' . $fechaVencimiento);
        }
        // -------------------------------
        // -------------------------------

        $plan = Plan::find($request->plan_id);
        $fechaInicio = Carbon::now();

        if ($plan->duration_days <= 1) {
            $fechaFin = Carbon::today()->endOfDay();
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

        return redirect()->route('subscriptions.create')
            ->with('success', '¡Pago registrado! El cliente tiene acceso hasta el ' . $fechaFin->format('d-m-Y') . ' a las ' . $fechaFin->format('H:i'));
    }
}
