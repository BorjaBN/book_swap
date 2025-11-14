# Sprint backlog 1

**Duración:** 5 nov - 18 nov

**Equipo:** Laura Infantes Corrales y Borja De La Cruz Lucio

**Objetivo:** funcionalidades clave para el registro de usuarios, visualización de créditos y alta de libros, además de consolidar la base técnica del proyecto.

---

### Historias de usuario

1. Registro en la plataforma

```
Como usuario no registrado aún,
quiero registrarme en la plataforma,
para acceder a BookSwap.

Criterios de aceptación:
- El visitante accede a la opción Registrarse desde la página principal
- Puede completar el formulario con datos: nombre (obligatorio), apellidos, correo electrónico (obligatorio), contraseña (obligatorio), teléfono y ciudad
- Se valida que el correo no esté ya registrado y que se rellenen los campos obligatorios
- Al registrarse, se muestra un mensaje de confirmación y se inicia sesión automáticamente
```

2. Alta de libros

```
Como usuario común, 
quiero dar de alta mis libros,
para poder intercambiarlos.

Criterios de aceptación:
- El usuario puede añadir un nuevo libro accediendo a la sección Mis libros, disponible dentro del apartado Libros
- El formulario permite ingresar los datos obligatorios título, autor, ISBN, año de publicación, estado, género y foto
- Al guardar, se muestra una confirmación
- El libro aparece en Mis libros y en el Catálogo
- Si faltan datos obligatorios, se muestra un mensaje de error indicando qué campos deben completarse
```

3. Consulta de créditos

```
Como usuario común,
quiero consultar mi saldo de créditos,
para poder saber cuántos puedo utilizar en intercambios. 

Criterios de aceptación: 
- El usuario puede consultar el saldo en la cabecera de la web, visible desde cualquier página
- Se muestra el saldo actual de créditos de forma clara y visible
- El saldo se actualiza automáticamente tras cada operación (recepción o gasto)
- Si el usuario no tiene créditos, se muestra un mensaje informativo
```

### Tareas técnicas

*   Creación del repositorio en GitHub y configuración inicial con distintas ramas de trabajo
*   Redacción del product backlog
*   Redacción de la guia de estilo
*   Elaboración de bocetos
*   Redacción del documento de arquitectura tecnológica
*   Redacción del sprint backlog
*   Creación de la base de datos en PhpMyAdmin con datos de prueba
*   Diseño del modelo E-R y diccionario de datos