<?php
// Obtener la información de la imagen de la base de datos

// Configurar la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_pathtoys";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT imagen_producto FROM juguetes WHERE id = id";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $imagenBase64 = $fila['imagen_producto'];

    // Mostrar la imagen en la etiqueta img
    echo '<img src="data:image/jpeg;base64,' . $imagenBase64 . '" alt="Imagen del juguete">';
} else {
    echo "No se encontró la imagen en la base de datos.";
}
?>