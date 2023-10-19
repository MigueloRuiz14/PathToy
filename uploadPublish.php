<?php
// Obtener los valores enviados desde el formulario
$tipoPublicacion = $_POST['tipoPublicacion'];
$imagenProducto = $_FILES['imagenProducto']['tmp_name'];
$descripcion = $_POST['descripcion'];
$habilidad = implode(",", $_POST['habilidad']);
$edad = $_POST['edad'];

// Verificar si los campos están vacíos
if (empty($tipoPublicacion) || empty($imagenProducto) || empty($descripcion) || empty($habilidad) || empty($edad)) {
    // Redirigir de vuelta a la página con un mensaje de error
    header("Location: publicar.php?error=empty");
    exit(); // Detener la ejecución del script
}

// Leer la imagen en formato de Base64
$imagenBase64 = base64_encode(file_get_contents($imagenProducto));

// Configurar la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_pathtoys";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Insertar los datos en la tabla correspondiente
$sql = "INSERT INTO juguetes (tipo_publicacion, imagen_producto, descripcion, habilidad, edad)
        VALUES ('$tipoPublicacion', '$imagenBase64', '$descripcion', '$habilidad', '$edad')";

if ($conn->query($sql) === true) {
    $error = "<li>Correo o contraseña incorrecto</li>";
    header("Location:panel_control.php");
} else {
    echo "Error al guardar los datos: " . $conn->error;
    header("Location:publicar.php");
}

// Cerrar la conexión
$conn->close();
?>