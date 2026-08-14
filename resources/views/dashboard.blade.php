<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Control - Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <!-- Encabezado con Saludo, Rol y Botón de Salir -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>👋 Bienvenido, {{ auth()->user()->name }}</h2>

            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-secondary fs-6">Rol: {{ strtoupper(auth()->user()->role) }}</span>

                <!-- Formulario seguro para cerrar sesión -->
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Cerrar Sesión</button>
                </form>
            </div>
        </div>

        <div class="row">
            <!-- Tarjeta 1: Gimnasio (Visible para TODOS) -->
            <div class="col-md-4">
                <div class="card shadow border-success mb-3">
                    <div class="card-body text-center">
                        <h4 class="mt-2">🏋️‍♂️ Recepción</h4>
                        <p class="text-muted">Cobrar visitas y membresías.</p>
                        <a href="{{ route('subscriptions.create') }}" class="btn btn-success w-100">Ir a Cobrar</a>
                    </div>
                </div>
            </div>

            <!-- 🔐 CANDADO INTELIGENTE: Solo el Jefe ve esto -->
            @if (auth()->user()->role == 'admin')
                <!-- Tarjeta 2: Reportes (Solo Admin) -->
                <div class="col-md-4">
                    <div class="card shadow border-info mb-3">
                        <div class="card-body text-center">
                            <h4 class="mt-2">📊 Reportes</h4>
                            <p class="text-muted">Corte de caja y ganancias.</p>
                            <a href="#" class="btn btn-info text-white w-100">Ver Ventas</a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 3: Personal (Solo Admin) -->
                <div class="col-md-4">
                    <div class="card shadow border-primary mb-3">
                        <div class="card-body text-center">
                            <h4 class="mt-2">🛡️ Personal</h4>
                            <p class="text-muted">Registrar nuevos empleados.</p>
                            <a href="{{ route('users.create') }}" class="btn btn-primary w-100">Administrar</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

</body>

</html>
