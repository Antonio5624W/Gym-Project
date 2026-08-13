<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renovar Membresía</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Botones de navegación -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <!-- Accesos rápidos a la izquierda -->
                    <div>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">⬅ Volver al Panel</a>
                        <a href="{{ route('clients.create') }}" class="btn btn-outline-primary">👤 Nuevo Miembro</a>
                    </div>

                    <!-- Botón de salir a la derecha -->
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Cerrar Sesión</button>
                    </form>
                </div>

                @if (session('success'))
                    <div class="alert alert-success fw-bold text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">💲 Cobrar Membresía</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('subscriptions.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Miembro</label>
                                <select name="client_id" class="form-select" required>
                                    <option value="">Seleccione un miembro...</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipo de Membresía</label>
                                <select name="plan_id" class="form-select" required>
                                    <option value="">Seleccione un plan...</option>
                                    @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}">
                                            {{ $plan->name }} - ${{ $plan->price }} ({{ $plan->duration_days }}
                                            días)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Cobrar y Activar Acceso</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        // Esperamos 4 segundos (4000 milisegundos)
        setTimeout(function() {
            let alerta = document.querySelector('.alert-success');
            if (alerta) {
                // Hacemos que se desvanezca suavemente
                alerta.style.transition = "opacity 0.5s ease";
                alerta.style.opacity = "0";

                // La eliminamos del código medio segundo después de desvanecerla
                setTimeout(() => alerta.remove(), 500);
            }
        }, 4000);
    </script>
</body>

</html>
