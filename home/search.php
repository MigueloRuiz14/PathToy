<?php
require_once('C://xampp/htdocs/PathToy/view/header.php');
if (empty($_SESSION['usuario'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Producto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/Pathtoy/asset/css/styles.css">
    <link rel="stylesheet" href="/Pathtoy/asset/css/search.css">
    <!-- ... Tus otros enlaces a estilos ... -->
</head>

<body>
    <a href="../../index.php" class="volver-button"><i class="fas fa-arrow-left"></i> Volver</a>


    <form id="searchForm" class="search-form">
        <input align-items="center" type="text" name="q" placeholder="Buscar...">

        <div class="filter-button">
            <button type="button" id="filterButton">Búsqueda Filtrada</button>
        </div>

        <div class="selectors" id="selectors" style="display: none;">
            <select name="tipo_publicacion">
                <option value="">Tipo de publicación</option>
                <option value="Intercambio">Intercambio</option>
                <option value="Petición">Petición</option>
                <option value="Donación">Donación</option>
            </select>

            <select name="edad">
                <option value="">Edad</option>
                <option value="1">1 año</option>
                <option value="2">2 años</option>
                <option value="3">3 años</option>
                <option value="4">4 años</option>
                <option value="5">5 años</option>
                <option value="6">6 años</option>
                <option value="7">7 años</option>
                <option value="8">8 años</option>
                <option value="9">9 años</option>
                <option value="10">10 años</option>
                <option value="11">11 años</option>
                <option value="12">12 años</option>
                <option value="13">13 años</option>
                <option value="14">14 años</option>
                <option value="15">15 años</option>
                <option value="16">16 años</option>
                <option value="17">17 años</option>
                <option value="18-99">18+ años</option>
                <!-- ... Otras opciones de edad ... -->
            </select>

            <select name="habilidad">
                <option value="">Habilidades</option>
                <option value="Habilidades Motoras">Motoras</option>
                <option value="Habilidades Cognitivas">Cognitivas</option>
                <option value="Habilidades Linguísticas">Linguísticas</option>
            </select>
        </div>

        <button class="bx bx-search icon" type="submit">Buscar</button>
    </form>



    <h2 class="centered-title">Publicaciones que te pueden interesar</h2>

    <section id="publicaciones">
        <div id="cardContainer" class="card-container">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_pathtoys";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Aquí realizas una consulta basada en los parámetros de búsqueda
            // y obtienes los resultados de la base de datos
            $sql = "SELECT id, tipo_publicacion, imagen_producto, descripcion, habilidad, edad, fecha_registro FROM juguetes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
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
                    // Mostrar las tarjetas de productos
                    echo '<div class="card">';
                    echo '<p style="text-align: right;">' . $fechaFormateada . /*' <br> ' . $horaFormateada .*/'</p>';
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
        </div>
    </section>
    <script src="../asset/js/main.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Captura el evento de envío del formulario
        $('#searchForm').submit(function (event) {
            event.preventDefault(); // Evita que se envíe el formulario de manera tradicional

            // Obtén los valores del formulario
            var formData = $(this).serialize();

            // Realiza la petición AJAX
            $.ajax({
                url: 'buscar_ajax.php', // Ruta del archivo PHP que maneja la búsqueda AJAX
                type: 'GET',
                data: formData,
                success: function (response) {
                    $('#cardContainer').html(response); // Actualiza el contenido con los resultados
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Captura el evento de clic en el botón "Búsqueda Avanzada"
        $('#advancedSearch').click(function () {
            var tipo_publicacion = $('select[name="tipo_publicacion"]').val();
            var edad = $('select[name="edad"]').val();
            var habilidad = $('select[name="habilidad"]').val();

            console.log("Tipo de publiación seleccionada: " + tipo_publicacion);
            console.log("Edad seleccionada: " + edad);
            console.log("Habilidad seleccionada: " + habilidad);

            // Realiza la búsqueda avanzada solo si ambos select tienen valores seleccionados
            if (tipo_publicacion !== "" && edad !== "" && habilidad !== "") {
                // Realiza la petición AJAX
                $.ajax({
                    url: 'buscar_ajax.php', // Ruta del archivo PHP que maneja la búsqueda AJAX
                    type: 'GET',
                    data: { tipo_publicacion: tipo_publicacion, edad: edad, habilidad: habilidad }, // Envia los parámetros al servidor
                    success: function (response) {
                        $('#cardContainer').html(response); // Actualiza el contenido con los resultados
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });


        // Muestra los selectores
        document.addEventListener("DOMContentLoaded", function () {
            const filterButton = document.getElementById("filterButton");
            const selectors = document.getElementById("selectors");

            filterButton.addEventListener("click", function () {
                if (selectors.style.display === "none" || selectors.style.display === "") {
                    selectors.style.display = "flex";
                } else {
                    selectors.style.display = "none";
                }
            });
        });

    </script>
</body>

</html>