<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Miembro</title>
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
                        <a href="{{ route('subscriptions.create') }}" class="btn btn-outline-success">💲 Ir a Cobrar</a>
                    </div>

                    <!-- Botón de salir a la derecha -->
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Cerrar Sesión</button>
                    </form>
                </div>

                @if (session('success'))
                    <div class="alert alert-success fw-bold">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">💪 Registrar Nuevo Miembro</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clients.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nombre Completo</label>
                                <input type="text" name="name" class="form-control" placeholder="Ej: Juan Pérez"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="number" name="phone" class="form-control" placeholder="Ej: 668-123-4567"
                                    required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email (Opcional)</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="correo@ejemplo.com">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Guardar Miembro</button>
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
