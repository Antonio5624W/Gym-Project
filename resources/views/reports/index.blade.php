<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes Financieros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📊 Reportes Financieros</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">⬅ Volver al Panel</a>
    </div>

    <!-- TARJETAS DE DINERO -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title">💰 Ingresos Hoy</h5>
                    <h2 class="fw-bold">${{ number_format($ingresosHoy, 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">📈 Ingresos del Mes</h5>
                    <h2 class="fw-bold">${{ number_format($ingresosMes, 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <h5 class="card-title">👥 Accesos Vendidos (Mes)</h5>
                    <h2 class="fw-bold">{{ $ventasMes }} registros</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- SECCIÓN DE DESCARGA DE PDFs -->
    <div class="card shadow border-dark">
        <div class="card-header bg-dark text-white fw-bold">
            📄 Exportar Reportes (PDF)
        </div>
        <div class="card-body text-center">
            <p>Descarga el historial de movimientos financieros listos para imprimir.</p>
            <div class="d-flex justify-content-center gap-3">
                <!-- AQUÍ ESTÁ LA MAGIA: Las rutas ya están conectadas y con target="_blank" -->
                <a href="{{ route('reports.daily') }}" class="btn btn-outline-success" target="_blank">📥 Corte Diario</a>
                <a href="{{ route('reports.weekly') }}" class="btn btn-outline-primary" target="_blank">📥 Reporte Semanal</a>
                <a href="{{ route('reports.monthly') }}" class="btn btn-outline-dark" target="_blank">📥 Reporte Mensual</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>