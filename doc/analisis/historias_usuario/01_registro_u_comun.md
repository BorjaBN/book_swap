## Registro de usuario común

Como usuario común, quiero registrarme en la plataforma proporcionando mis datos básicos (nombre, apellidos, correo electrónico, contraseña, telefono y ciudad) para poder crear una cuenta, iniciar sesión y acceder a las funcionalidades de BookSwap.

Criterios de aceptación:

    El sistema debe permitir el registro solo si todos los campos obligatorios están completos y son válidos.

    El correo electrónico no debe existir previamente en la base de datos.

    Si el registro es exitoso, el sistema debe crear la cuenta y redirigir al inicio.

    Si hay errores (campos que no cumplen las validaciones, correo electrónico duplicado), el sistema debe mostrar mensajes claros indicando el problema.