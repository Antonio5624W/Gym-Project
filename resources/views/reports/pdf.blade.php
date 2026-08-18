<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Financiero</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .cabecera { text-align: center; margin-bottom: 20px; }
        .cabecera h2 { margin: 0; color: #333; }
        .cabecera p { margin: 5px 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; color: #333; }
        .total { text-align: right; font-size: 18px; font-weight: bold; margin-top: 20px; color: #198754; }
    </style>
</head>
<body>

    <div class="cabecera">
        <h2> Gimnasio - Reporte de Ingresos</h2>
        <p>{{ $titulo }}</p>
        <p>Generado por: {{ Auth::user()->name }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha y Hora</th>
                <th>Miembro</th>
                <th>Tipo de Pase</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
            <tr>
                <td>{{ $pago->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $pago->client->name ?? 'Cliente Borrado' }}</td>
                <td>{{ $pago->plan->name ?? 'N/A' }}</td>
                <td>${{ number_format($pago->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Ingresado: ${{ number_format($total, 2) }}
    </div>

</body>
</html>