<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Intercambio aceptado</title>
</head>
<body style="font-family: Arial, sans-serif; color:#333;">

    <h2 style="color:#2c7be5;">¡Tu intercambio ha sido aceptado!</h2>

    <p>Buenas {{ $solicitante->nombre }},</p>

    <p>
        El propietario ha aceptado tu solicitud de intercambio del libro:
        <strong>{{ $libro->titulo }}</strong>.
    </p>

    <p>Puedes ponerte en contacto con él para coordinar la entrega:</p>

    <ul>
        <li><strong>Nombre:</strong> {{ $propietario->nombre }}</li>
        <li><strong>Email:</strong> {{ $propietario->email }}</li>

        @if($propietario->telefono)
            <li><strong>Teléfono:</strong> {{ $propietario->telefono }}</li>
        @endif
    </ul>

    <p>
        Gracias por usar <strong>BookSwap</strong>.  
        ¡Esperamos que disfrutes del intercambio!
    </p>

</body>
</html>
