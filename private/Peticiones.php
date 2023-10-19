<?php
require_once('C://xampp/htdocs/PathToy/view/header.php');
require_once('C://xampp/htdocs/PathToy/view/footer.php');

// Reemplaza esto con la lógica para obtener la información del usuario desde la base de datos
// Aquí estamos usando valores ficticios para demostración
$nombreUsuario = "Nombre del Usuario"; // Cambia esto con el nombre real del usuario
$fotoPerfil = "ruta/a/la/foto.png"; // Cambia esto con la ruta real de la foto de perfil
$cantidadIntercambios = 5; // Cambia esto con la cantidad real de intercambios
$cantidadPeticiones = 3; // Cambia esto con la cantidad real de peticiones
$cantidadDonaciones = 2; // Cambia esto con la cantidad real de donaciones

// Supongamos que tienes un historial de intercambios, peticiones y donaciones en forma de matrices (arrays)
// Cada elemento de la matriz representa un evento
$historialIntercambios = [
    ['fecha' => '2023-08-01', 'descripcion' => 'Intercambio 1'],
    ['fecha' => '2023-07-15', 'descripcion' => 'Intercambio 2'],
    // Agrega más eventos de intercambio según sea necesario
];
?>

<head>
  <link rel="stylesheet" href="/PathToy/asset/css/styles.css">
  <style>
        .list-group-item {
            border: 1px solid #000; /* Ancho y color del borde */
            margin-bottom: 10px; /* Espacio entre elementos de la lista */
        }
    </style>
</head>

<div class="fondo-login">
<div class="container">
        <div class="row">
            <div class="col-2">
  
              <div class="image"><img src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil"></div>
            </div>
            <div class="col-2">Intercambio</div>
            <div class="col-2">Peticiones</div>
            <div class="col-2">Donaciones</div>
        </div>
        <div class="row">
          <div class="col-2"></div>
          <div class="col-2"><?php echo $cantidadIntercambios; ?></div>
          <div class="col-2"><?php echo $cantidadPeticiones; ?></div>
          <div class="col-2"><?php echo $cantidadDonaciones; ?></div>
        </div>
<br><br>
<div class="row">
  <div class="col-3"></div>
  <div class="col-3">Historial de intercambios</div>
</div>
<br>
    <div style="width: 650px">
    <ul class="list-group">
    <li class="list-group-item list-group-item-secondary"> 
        <div class="row">
          <div class="col-3"><img src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil"></div>
          <div class="col-3">especificar</div>
          <div class="col-3"><a href="#">Peticion</a></div>
          <div class="col-3"><a href="#">Ver</a></div>
        </div>
  </li>
    <br>
    <li class="list-group-item list-group-item-secondary"> 
        <div class="row">
          <div class="col-3"><img src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil"></div>
          <div class="col-3">especificar</div>
          <div class="col-3"><a href="#">Peticion</a></div>
          <div class="col-3"><a href="#">Ver</a></div>
        </div>
  </li>
    <br>
    <li class="list-group-item list-group-item-secondary"> 
        <div class="row">
          <div class="col-3"><img src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil"></div>
          <div class="col-3">especificar</div>
          <div class="col-3"><a href="#">Peticion</a></div>
          <div class="col-3"><a href="#">Ver</a></div>
        </div>
  </li>
    <br>
    <li class="list-group-item list-group-item-secondary"> 
        <div class="row">
          <div class="col-3"><img src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil"></div>
          <div class="col-3">especificar</div>
          <div class="col-3"><a href="#">Peticion</a></div>
          <div class="col-3"><a href="#">Ver</a></div>
        </div>
  </li>
    <br>
    </ul>
    </div>
</div>


    <br>
    
  



</div>



<div class="fondo-login">
  <div class="container">
    <h1>Mi Cuenta</h1>
    <div class="perfil-info">
      <div class="perfil-image">
        <img src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil">
      </div>
      <div class="perfil-stats">
        <p>Nombre: <?php echo $nombreUsuario; ?></p>
        <p>Cantidad de Intercambios: <?php echo $cantidadIntercambios; ?></p>
        <p>Cantidad de Peticiones: <?php echo $cantidadPeticiones; ?></p>
        <p>Cantidad de Donaciones: <?php echo $cantidadDonaciones; ?></p>
      </div>
    </div>

    <h2>Historial de Peticiones</h2>
    <ul>
      <?php foreach ($historialIntercambios as $evento): ?>
        <li><?php echo $evento['fecha'] . ': ' . $evento['descripcion']; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php require_once('C://xampp/htdocs/PathToy/view/footer.php'); ?>
