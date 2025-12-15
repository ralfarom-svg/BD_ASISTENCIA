<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>QR Registrado</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .card {
            border: 2px solid #4A83F5;
            padding: 25px;
            border-radius: 10px;
            width: 80%;
            margin: auto;
        }
        .foto {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            margin-bottom: 10px;
            object-fit: cover;
            border: 2px solid #4A83F5;
        }
        .qr {
            width: 180px;
            margin-top: 15px;
        }
        h2 {
            color: #4A83F5;
            margin-bottom: 15px;
        }
        p {
            font-size: 14px;
            margin: 2px 0;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Estudiante Registrado</h2>

    {{-- DATOS --}}
    <p><strong>{{ $estudiante->nombres }} {{ $estudiante->apellidos }}</strong></p>
    <p>DNI: {{ $estudiante->dni }}</p>
    <p>Grado y Sección: {{ ucfirst($estudiante->grado) }} - {{ strtoupper($estudiante->seccion) }}</p>

    {{-- QR DESDE STORAGE --}}
    <img src="{{ public_path('storage/' . $estudiante->codigo_qr) }}" class="qr">

</div>

</body>
</html>
