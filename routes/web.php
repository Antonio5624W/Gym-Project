<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

// --- ZONA PÚBLICA (Cualquiera entra) ---
Route::get('/', function () {
    return redirect()->route('login'); // La raíz te manda al login
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- ZONA PRIVADA (Protegida por 'auth') ---
Route::middleware(['auth', \App\Http\Middleware\PreventBackHistory::class])->group(function () {
    
    // Panel Principal limpio
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Pantalla de Reportes Financieros y Descargas PDF
    Route::get('/reportes', [DashboardController::class, 'reports'])->name('reports.index');
    Route::get('/reportes/diario', [DashboardController::class, 'exportDaily'])->name('reports.daily');
    Route::get('/reportes/semanal', [DashboardController::class, 'exportWeekly'])->name('reports.weekly');
    Route::get('/reportes/mensual', [DashboardController::class, 'exportMonthly'])->name('reports.monthly');
    
    // Gestión de Personal
    Route::get('/registrar-personal', [UserController::class, 'create'])->name('users.create');
    Route::post('/registrar-personal', [UserController::class, 'store'])->name('users.store');
    
    // Miembros
    Route::get('/nuevo-miembro', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/guardar-miembro', [ClientController::class, 'store'])->name('clients.store');

    // Pagos
    Route::get('/pagar', [SubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::post('/pagar', [SubscriptionController::class, 'store'])->name('subscriptions.store');

});