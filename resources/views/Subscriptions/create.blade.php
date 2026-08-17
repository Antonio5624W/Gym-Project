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
                    <div>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">⬅ Volver al Panel</a>
                        <a href="{{ route('clients.create') }}" class="btn btn-outline-primary">👤 Nuevo Miembro</a>
                    </div>

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

                            <!-- AQUÍ ESTÁ LA NUEVA BARRA DE BÚSQUEDA DIRECTA -->
                            <div class="mb-3">
                                <label class="form-label">Escribe el nombre del Miembro</label>
                                
                                <!-- 1. El campo visible donde el usuario escribe directo -->
                                <input type="text" class="form-control" list="listaClientes" id="buscadorNombres" placeholder="Ej. Juan Pérez..." autocomplete="off" required>
                                
                                <!-- 2. La lista de sugerencias que autocompleta mientras escribe -->
                                <datalist id="listaClientes">
                                    @foreach ($clients as $client)
                                        <option data-id="{{ $client->id }}" value="{{ $client->name }}"></option>
                                    @endforeach
                                </datalist>

                                <!-- 3. El campo invisible que guarda el ID real para la Base de Datos -->
                                <input type="hidden" name="client_id" id="clienteIdOculto" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipo de Membresía</label>
                                <select name="plan_id" class="form-select" required>
                                    <option value="" disabled selected>Seleccione un plan...</option>
                                    @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}">
                                            {{ $plan->name }} - ${{ $plan->price }} ({{ $plan->duration_days }} días)
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

    <!-- Script para ocultar alerta de éxito -->
    <script>
        setTimeout(function() {
            let alerta = document.querySelector('.alert-success');
            if (alerta) {
                alerta.style.transition = "opacity 0.5s ease";
                alerta.style.opacity = "0";
                setTimeout(() => alerta.remove(), 500);
            }
        }, 4000);
    </script>

    <!-- Script súper ligero para conectar el Nombre escrito con su ID de la base de datos -->
    <script>
        const inputBuscador = document.getElementById('buscadorNombres');
        const inputOculto = document.getElementById('clienteIdOculto');
        const opciones = document.getElementById('listaClientes').options;

        inputBuscador.addEventListener('input', function() {
            inputOculto.value = ""; // Limpiamos por seguridad
            
            // Si el texto escrito coincide con un nombre, guardamos su ID en secreto
            for (let i = 0; i < opciones.length; i++) {
                if (opciones[i].value === inputBuscador.value) {
                    inputOculto.value = opciones[i].getAttribute('data-id');
                    break;
                }
            }
        });
    </script>
</body>
</html>