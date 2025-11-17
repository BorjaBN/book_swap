<?php 

//Espacio reservado para funcionalidades de versión 0.2 :)

?> 

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi perfil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="/book_swap/fuente/www/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>


  <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
    <img src="img/logo.png" style="height: 60px;">
    <button class="btn btn-outline-secondary">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>


  <div class="text-center mt-4">
    <h5 class="fw-bold">Mi perfil</h5>
    <p class="text-muted">Usuario</p>
    <img src="img/icono_perfil.jpg" class="img-fluid rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
  </div>

  <div class="container mt-4">
    <div class="card p-3 shadow-sm">
        <div class="text-end">
            <a href="#" class="btn btn-sm btn-outline-primary">Editar</a>
        </div>
        <p><strong>Nombre:</strong> <?php echo $_SESSION['usuario']['nombre']; ?></p>
        <p><strong>Apellidos:</strong> <?php echo $_SESSION['usuario']['apellidos']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['usuario']['email']; ?></p>
        <p><strong>Teléfono:</strong> <?php echo $_SESSION['usuario']['telefono']; ?></p>
        <p><strong>Ciudad:</strong> <?php echo $_SESSION['usuario']['ciudad']; ?></p>
      
    </div>

    <div class="text-center mt-3">
      <button class="btn btn-outline-danger">Eliminar perfil</button>
    </div>
  </div>


  <nav class="navbar fixed-bottom bg-white border-top">
    <div class="container d-flex justify-content-around">
      <button class="btn btn-outline-danger">Datos</button>
      <button class="btn btn-outline-danger">Valoraciones</button>
      <button class="btn btn-outline-danger">Solicitudes</button>
      <button class="btn btn-outline-danger">Eventos</button>
    </div>
  </nav>

</body>
</html>

