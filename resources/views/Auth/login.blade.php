<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acceso Admin-Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card shadow p-4" style="width: 400px;">
        <div class="text-center mb-4">
            <h3>🔒 Gym Manager</h3>
            <p class="text-muted">Solo Personal Autorizado</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-4">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <!-- Input con el ID que buscará nuestro JavaScript -->
                    <input type="password" name="password" id="loginPasswordInput" class="form-control"
                        placeholder="Ingresa tu contraseña" required>

                    <!-- Botón del ojito -->
                    <button class="btn btn-outline-secondary" type="button" id="toggleLoginPassword">
                        👁️
                    </button>
                </div>
            </div>

            @error('email')
                <div class="alert alert-danger text-center">{{ $message }}</div>
            @enderror

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Entrar al Sistema</button>
            </div>
        </form>
    </div>
    <script>
        // Seleccionamos el botón y el campo del login
        const toggleLogin = document.querySelector('#toggleLoginPassword');
        const inputLogin = document.querySelector('#loginPasswordInput');

        // Agregamos el evento del clic
        toggleLogin.addEventListener('click', function() {
            // Alternamos entre 'text' y 'password'
            const type = inputLogin.getAttribute('type') === 'password' ? 'text' : 'password';
            inputLogin.setAttribute('type', type);

            // Cambiamos el icono visualmente
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });
    </script>
</body>

</html>
