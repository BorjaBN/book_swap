<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Intercambio aceptado</title>
</head>
<body style="font-family: Arial, sans-serif; color:#333;">

    <h2 style="color:#2c7be5;">Has aceptado un intercambio</h2>

    <p>Hola {{ $propietario->nombre }},</p>

    <p>
        Has aceptado la solicitud de intercambio del libro:
        <strong>{{ $libro->titulo }}</strong>.
    </p>

    <p>Puedes ponerte en contacto con el solicitante para coordinar la entrega:</p>

    <ul>
        <li><strong>Nombre:</strong> {{ $solicitante->nombre }}</li>
        <li><strong>Email:</strong> {{ $solicitante->email }}</li>

        @if($solicitante->telefono)
            <li><strong>Teléfono:</strong> {{ $solicitante->telefono }}</li>
        @endif
    </ul>

    <p>
        <strong>Libro que entregas:</strong> {{ $libro->titulo }}
    </p>

    @if($libroOfrecido)
        <p>
            <strong>Libro que recibirás:</strong> {{ $libroOfrecido->titulo }}
        </p>
    @endif

    <p>
        Gracias por usar <strong>BookSwap</strong>.  
        ¡Esperamos que disfrutes del intercambio!
    </p>

</body>
</html>
