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

  $sql = "DELETE FROM juguetes WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    echo "Registro eliminado con éxito";
  } else {
    echo "Error al eliminar el registro: " . $conn->error;
  }
}

$conn->close();
?>
