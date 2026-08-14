<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Botones de navegación con Cierre de Sesión seguro -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">⬅ Volver al Panel</a>
                
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Cerrar Sesión</button>
                </form>
            </div>

            <!-- Alerta de éxito -->
            @if(session('success'))
                <div class="alert alert-success fw-bold text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulario de Registro -->
            <div class="card shadow border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">🛡️ Registrar Nuevo Empleado</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf 

                        <div class="mb-3">
                            <label class="form-label">Nombre Completo</label>
                            <input type="text" name="name" class="form-control" placeholder="Ej: Juan Pérez" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo (Usuario de Acceso)</label>
                            <input type="email" name="email" class="form-control" placeholder="empleado@gym.com" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Selector de Roles -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Privilegios (Rol en el sistema)</label>
                            <select name="role" class="form-select border-primary" required>
                                <option value="" disabled selected>Seleccione el nivel de acceso...</option>
                                <option value="recepcion">Recepción (Solo registrar y cobrar)</option>
                                <option value="admin">Administrador (Acceso total y reportes)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Contraseña Temporal</label>
                            <input type="password" name="password" class="form-control" placeholder="Mínimo 6 caracteres" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Crear Cuenta de Acceso</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

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

</body>
</html>