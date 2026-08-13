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

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
        
            @error('email')
                <div class="alert alert-danger text-center">{{ $message }}</div>
            @enderror

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Entrar al Sistema</button>
                </div>
        </form>
    </div>

</body>
</html>