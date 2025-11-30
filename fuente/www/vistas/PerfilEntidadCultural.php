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
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet"> <!--Tipografia-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>


  <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
    <img src="img/logo.png" style="height: 60px;">
    
  </div>


  <div class="text-center mt-4">
    <h5 class="fw-bold" style="font-family: 'Playfair Display', serif;">Mi perfil</h5>
    <p class="text-muted" style="font-family: 'Playfair Display', serif;">Entidad Cultural</p>
    <img src="img/icono_perfil.jpg" class="img-fluid rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
  </div>

  <div class="container mt-4">
    <div class="card p-3 shadow-sm">
      <p><strong>Nombre:</strong> <?php echo $_SESSION['usuario']['nombre']; ?></p>
      <p><strong>Email:</strong> <?php echo $_SESSION['usuario']['email']; ?></p>
      <p><strong>Teléfono:</strong> <?php echo $_SESSION['usuario']['telefono']; ?></p>
      <p><strong>Ciudad:</strong> <?php echo $_SESSION['usuario']['ciudad']; ?></p>
      <div class="text-end">
        <a href="#" class="btn btn-sm btn btn-registrarse">Editar</a>
      </div>
    </div>

    <div class="text-center mt-3">
      <button class="btn btn-registrarse">Eliminar perfil</button>
    </div>
  </div>


  <nav class="navbar fixed-bottom bg-white border-top">
    <div class="container d-flex justify-content-around">
      
    </div>
  </nav>

</body>
</html>
