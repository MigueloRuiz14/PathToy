<?php
require_once('C://xampp/htdocs/PathToy/view/header.php');

if (empty($_SESSION['usuario'])) {
  header("Location:login.php");
}

$usuario = $_SESSION['usuario'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_pathtoys";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT nombre, apellido, correo FROM usuarios WHERE correo = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $nombreUsuario = $row['nombre'];
  $apellidoUsuario = $row['apellido'];
  $correoUsuario = $row['correo'];
} else {
  $nombreUsuario = "";
  $apellidoUsuario = "";
  $correoUsuario = "";
}

$conn->close();
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los valores actualizados del formulario
  $nuevoNombre = $_POST['nombre'];
  $nuevoApellido = $_POST['apellido'];
  $nuevoCorreo = $_POST['correo'];

  // Procesar la imagen
  // if (isset($_FILES['userfile'])) {
  //   $imgData = addslashes(file_get_contents($_FILES['userfile']['tmp_name']));
  //   $conn = new mysqli($servername, $username, $password, $dbname);
  //   if ($conn->connect_error) {
  //     die("Error de conexión: " . $conn->connect_error);
  //   }

  //   $sql = "UPDATE usuarios SET imagen='$imgData' WHERE correo='$usuario'";
  //   if ($conn->query($sql) === TRUE) {
  //     // Actualización exitosa, recargar la página
  //     header("Location: perfil.php");
  //     exit();
  //   } else {
  //     echo "Error al actualizar los datos: " . $conn->error;
  //   }

  //   $conn->close();
  // }

  // Verificar si se realizaron modificaciones
  if ($nuevoNombre != $nombreUsuario || $nuevoApellido != $apellidoUsuario || $nuevoCorreo != $correoUsuario) {
    // Verificar si hay campos vacíos
    if (!empty($nuevoNombre) && !empty($nuevoApellido) && !empty($nuevoCorreo)) {
      // Realizar la actualización en la base de datos
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
      }

      $sql = "UPDATE usuarios SET nombre='$nuevoNombre', apellido='$nuevoApellido' WHERE correo='$usuario'";
      if ($conn->query($sql) === TRUE) {
        // Actualización exitosa, redirigir a la página de perfil nuevamente
        header("Location: perfil.php?mensaje=actualizado");
        exit();
      } else {
        echo "Error al actualizar los datos: " . $conn->error;
      }

      $conn->close();
    } else {
      // Campos vacíos, mostrar mensaje de error
      header("Location: perfil.php?mensaje=campos_vacios");
      exit();
    }
  } else {
    // No se realizaron modificaciones, mostrar mensaje de error
    header("Location: perfil.php?mensaje=sin_modificaciones");
    exit();
  }
}



?>

<head>

  <link rel="stylesheet" href="/PathToy/asset/css/styles.css">
  <link rel="stylesheet" href="/PathToy/asset/css/perfil.css">
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      const mensaje = document.querySelector('.mensaje');
      if (mensaje) {
        setTimeout(() => {
          mensaje.style.display = 'none';
        }, 2500);
      }
    });
  </script>
</head>

<div class="background">
  <div class="perfil-form">
    <h1 class="titulo">Información del Usuario</h1>
    <div id="cameraImage" class="perfil-logo">
      <img class="camera" src="/PathToy/asset/img/camara.png" alt="Camara">
    </div>
    <a href="#" class="editar-info">Editar Información</a>
    <form id="form-perfil" action="perfil.php" method="POST" class="form-perfil" enctype="multipart/form-data">
      <input type="text" id="nombre" name="nombre" class="input-perfil" value="<?php echo $nombreUsuario; ?>" readonly>
      <input type="text" id="apellido" name="apellido" class="input-perfil" value="<?php echo $apellidoUsuario; ?>"
        readonly>
      <input type="email" id="correo" name="correo" class="input-perfil" value="<?php echo $correoUsuario; ?>" readonly>
      <input type="file" id="inputFile" name="userfile" accept="image/*" style="display: none;">
      <button type="submit" id="btn-actualizar" class="btn-actualizar"><b>Actualizar Cambios</b></button>
      <button type="button" id="btn-cancelar" class="btn-cancelar" onclick="cancelarEdicion()"><b>Cancelar</b></button>
      <!-- <button type="submit" class="btn-eliminar"><b>Eliminar perfil</b></button> -->
    </form>

    <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === "campos_vacios"): ?>
      <div class="mensaje">Rellene todos los campos antes de actualizar</div>
    <?php elseif (isset($_GET['mensaje']) && $_GET['mensaje'] === "actualizado"): ?>
      <div class="mensaje">Datos actualizados correctamente</div>
    <?php elseif (isset($_GET['mensaje']) && $_GET['mensaje'] === "sin_modificaciones"): ?>
      <div class="mensaje">Debes editar los datos antes de actualizar</div>
    <?php endif; ?>
  </div>

  <div class="perfil-form form-perfil">
    <h1 class="titulo">Estadisticas</h1>
    <a href="Intercambios.php">
      <button type="text" id="intercambios" name="intercambios" class="input-perfil"> <b>Mis Intercambios</b> </button>
    </a>
    <a href="Donaciones.php">
      <button type="text" id="donaciones" name="donaciones" class="input-perfil"> <b>Mis Donaciones</b> </button>
    </a>
    <a href="Peticiones.php">
      <button type="text" id="peticiones" name="peticiones" class="input-perfil"> <b>Mis Peticiones</b> </button>
    </a>
  </div>
</div>

<script src="../../asset/js/main.js"></script>
<script src="../../asset/js/profile.js"></script>

<?php
require_once('C://xampp/htdocs/PathToy/view/footer.php');
?>