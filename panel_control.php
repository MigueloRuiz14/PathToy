<?php
require_once('c://xampp/htdocs/PathToy/view/header.php');
if (empty($_SESSION['usuario'])) {
  header("Location:login.php");
}
?>

<head>
  <link rel="stylesheet" href="/PathToy/asset/css/styles.css">
  <link rel="stylesheet" href="/PathToy/asset/css/panel.css">
  <style>
    .card-image img {
      width: 200px;
      /* Ancho deseado */
      height: 250px;
      /* Altura automática para mantener la proporción */
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    function habilitarEdicion() {
      var campos = document.getElementsByClassName('campo-editable');
      var btnActualizar = document.getElementsByClassName('btn-actualizar');
      var btnGuardar = document.getElementsByClassName('btn-guardar');

      for (var i = 0; i < campos.length; i++) {
        campos[i].innerHTML = '<input type="text" value="' + campos[i].innerText + '">';
        btnActualizar[i].style.display = 'none';
        btnGuardar[i].style.display = 'inline';
      }
    }

    function guardarCambios() {
      var campos = document.getElementsByClassName('campo-editable');
      var btnActualizar = document.getElementsByClassName('btn-actualizar');
      var btnGuardar = document.getElementsByClassName('btn-guardar');

      for (var i = 0; i < campos.length; i++) {
        var valorEditado = campos[i].querySelector('input').value;
        campos[i].innerHTML = valorEditado;
        btnActualizar[i].style.display = 'inline';
        btnGuardar[i].style.display = 'none';

        // Obtener el ID del registro
        var id = campos[i].getAttribute('data-id');

        // Enviar el valor editado al servidor para guardar en la base de datos
        $.ajax({
          url: '/PathToy/home/guardar_registro.php', // Ruta del archivo PHP que guarda los datos
          method: 'POST',
          data: { id: id, valor: valorEditado },
          success: function (response) {
            // Manejar la respuesta del servidor
            console.log(response);
            // Mostrar mensaje de éxito
            alert('Datos actualizados con éxito');
          },
          error: function (xhr, status, error) {
            // Manejar el error en caso de fallo en la petición
            console.error(error);
          }
        });
      }
    }

    function eliminarRegistro(id) {
      // Enviar el ID del registro al archivo PHP para eliminarlo de la base de datos
      if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
        $.ajax({
          url: '/PathToy/home/eliminar_registro.php', // Ruta del archivo PHP que elimina el registro
          method: 'POST',
          data: { id: id },
          success: function (response) {
            // Manejar la respuesta del servidor
            console.log(response);
            // Mostrar mensaje de éxito
            alert('Registro eliminado con éxito');
            // Recargar la página para actualizar la lista de registros
            location.reload();
          },
          error: function (xhr, status, error) {
            // Manejar el error en caso de fallo en la petición
            console.error(error);
          }
        });
      }
    }
  </script>
</head>

<h1 class="text-center mt-4">Publicaciones</h1>

<script src="../asset/js/main.js"></script>

<?php
require_once('c://xampp/htdocs/PathToy/view/footer.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_pathtoys";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

$current_time = date("Y-m-d H:i:s");
$twenty_four_hours_ago = date("Y-m-d H:i:s", strtotime('-24 hours', strtotime($current_time)));

$sql = "SELECT id, tipo_publicacion, imagen_producto, descripcion, habilidad, edad, fecha_registro 
        FROM juguetes 
        WHERE fecha_registro >= '$twenty_four_hours_ago'
        ORDER BY fecha_registro DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Mostrar los datos de la tabla juguetes
  echo '<div class="card-container">';
  while ($row = $result->fetch_assoc()) {
    $fechaRegistro = $row['fecha_registro'];
    $fecha = date_create($fechaRegistro);
    $meses = array(
      'Enero',
      'Febrero',
      'Marzo',
      'Abril',
      'Mayo',
      'Junio',
      'Julio',
      'Agosto',
      'Septiembre',
      'Octubre',
      'Noviembre',
      'Diciembre'
    );
    $mes = $meses[(date_format($fecha, 'n') - 1)];
    $hora = date_format($fecha, 'H');
    $minuto = date_format($fecha, 'i');
    $fechaFormateada = date_format($fecha, 'd') . " de " . $mes . " - " . date_format($fecha, 'Y');
    $horaFormateada = $hora . ":" . $minuto;
    echo '<div class="card">';
    echo '<p style="text-align: right;">' . $fechaFormateada . /*' <br> ' . $horaFormateada .*/'</p>';
    echo '<div class="card-image">';
    echo '<img src="data:image/jpeg;base64,' . $row['imagen_producto'] . '" alt="Imagen del producto">';
    echo '</div>';
    echo '<div class="card-content">';
    echo '<h2 class="campo-editable" data-id="' . $row['id'] . '">' . $row['tipo_publicacion'] . '</h2>';
    echo '<p>Descripción: <span class="campo-editable" data-id="' . $row['id'] . '">' . $row['descripcion'] . '</span></p>';
    $habilidad = explode(",", $row["habilidad"]);
    echo '<p>Habilidad requerida: </p>';
    foreach ($habilidad as $habilidad) {
      echo $habilidad . " ";
    }
    echo '<br>';
    echo '<p>Edad recomendada: <span class="campo-editable" data-id="' . $row['id'] . '">' . $row['edad'] . '</span></p>';
    // echo '<button class="btn-actualizar" onclick="habilitarEdicion()">Editar</button>';
    // echo '<button class="btn-guardar" style="display: none;" onclick="guardarCambios()">Guardar</button>';
    // echo '<button class="btn-eliminar" onclick="eliminarRegistro(' . $row['id'] . ')">Eliminar</button>';
    echo '</div>';
    echo '<div class="card-botones">';
    echo '<button class="btn-ver">Ver</button>';
    echo '</div>';
    echo '</div>';
    echo "<br>";
  }
} else {
  echo '<p class="text-center">No se encontraron publicaciones.</p>';
}
echo '</div>';

$conn->close();
?>