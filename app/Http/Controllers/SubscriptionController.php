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
        $fechaFin = Carbon::now()->addDays($plan->duration_days);

        Subscription::create([
            'client_id' => $request->client_id,
            'plan_id' => $plan->id,
            'start_date' => $fechaInicio,
            'end_date' => $fechaFin,
            'price' => $plan->price
        ]);

        return redirect()->route('subscriptions.create')
            ->with('success', '¡Pago registrado!El cliente tiene acceso hasta ' . $fechaFin->format('d-m-Y'));
    }
}
