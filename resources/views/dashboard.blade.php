<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    
    <!-- ENCABEZADO ACTUALIZADO CON EL NOMBRE DEL GIMNASIO -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <!-- Aquí el sistema imprime a qué gimnasio pertenece el usuario -->
            <h5 class="text-muted mb-0">🏢 {{ Auth::user()->gym?->name ?? 'Mi Gimnasio' }}</h5>
            <h2>👋 Bienvenido, {{ Auth::user()->name }}</h2>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-secondary px-3 py-2">Rol: {{ strtoupper(Auth::user()->role) }}</span>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    <!-- Las 3 tarjetas principales -->
    <div class="row text-center mt-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-success">
                <div class="card-body py-4">
                    <h4 class="mb-3">🏋️ Recepción</h4>
                    <p class="text-muted">Cobrar visitas y membresías.</p>
                    <a href="{{ route('subscriptions.create') }}" class="btn btn-success w-100">Ir a Cobrar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-info">
                <div class="card-body py-4">
                    <h4 class="mb-3">📊 Reportes</h4>
                    <p class="text-muted">Corte de caja y ganancias.</p>
                    <a href="{{ route('reports.index') }}" class="btn btn-info w-100 text-white">Ver Ventas</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-primary">
                <div class="card-body py-4">
                    <h4 class="mb-3">🛡️ Personal</h4>
                    <p class="text-muted">Registrar nuevos empleados.</p>
                    <a href="{{ route('users.create') }}" class="btn btn-primary w-100">Administrar</a>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>