<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_pathtoys";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los valores del formulario AJAX
$q = isset($_GET['q']) ? $_GET['q'] : '';
$tipo_publicacion = isset($_GET['tipo_publicacion']) ? $_GET['tipo_publicacion'] : '';
$edad = isset($_GET['edad']) ? $_GET['edad'] : '';
$habilidad = isset($_GET['habilidad']) ? $_GET['habilidad'] : '';

// Construir la consulta SQL basada en los parámetros de búsqueda
$sql = "SELECT id, tipo_publicacion, imagen_producto, descripcion, habilidad, edad FROM juguetes WHERE descripcion LIKE '%$q%'";

if (!empty($tipo_publicacion)) {
    $sql .= " AND tipo_publicacion = '$tipo_publicacion'";
}

if (!empty($edad)) {
    $sql .= " AND edad = '$edad'";
}

if (!empty($habilidad)) {
    $sql .= " AND habilidad LIKE '%$habilidad%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Mostrar las tarjetas de productos
        echo '<div class="card">';
        echo '<div class="card-image">';
        // Muestra la imagen si tienes una imagen en formato base64
        echo '<img src="data:image/jpeg;base64,' . $row['imagen_producto'] . '" alt="Imagen del producto">';
        echo '</div>';
        echo '<div class="card-content">';
        echo '<h2>' . $row['tipo_publicacion'] . '</h2>';
        echo '<p>Descripción: ' . $row['descripcion'] . '</p>';
        $habilidad = explode(",", $row["habilidad"]);
        echo '<p>Habilidad requerida: </p>';
        foreach ($habilidad as $habilidad) {
            echo $habilidad . " ";
        }
        echo '<p>Edad recomendada: ' . $row['edad'] . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p class="text-center">No se encontraron publicaciones.</p>';
}

$conn->close();
?>