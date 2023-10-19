<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_pathtoys";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $valor = $_POST['valor'];

  $sql = "UPDATE juguetes SET valor_columna = '$valor' WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    echo "Datos actualizados con éxito";
  } else {
    echo "Error al actualizar los datos: " . $conn->error;
  }
}

$conn->close();
?>
