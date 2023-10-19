<?php
require_once('C://xampp/htdocs/PathToy/view/header.php');
if (empty($_SESSION['usuario'])) {
    header("Location:login.php");
}
?>
<?php if ($page = "publicar")
    ; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/Pathtoy/asset/css/styles.css">
    <title>Publicar Producto</title>
</head>

<body class="body-publish">
    <a href="../../index.php" class="volver-button"><i class="fas fa-arrow-left"></i> Volver</a>

    <?php
    if (isset($_GET['error']) && $_GET['error'] == "empty") {
        echo "<p class='error-message'>Por favor, rellena todos los campos antes de publicar.</p>";
    }
    ?>

    <div id="TituloPublicacion">
        <h1>Tipo de Publicación</h1>
    </div>


    <form action="uploadPublish.php" method="POST" enctype="multipart/form-data">
        <select id="myComboBox" name="tipoPublicacion">
            <option disabled selected>Seleccione el tipo de publicación</option>
            <option value="Intercambio">Intercambio</option>
            <option value="Petición">Petición</option>
            <option value="Donación">Donación</option>
        </select>

        <div id="ImagenP">
            <h1>Imagen del juguete</h1>
            <div id="cuadroImagen">
                <input type="file" id="imagenProducto" name="imagenProducto" accept="image/*">
                <label for="imagenProducto" id="labelImagen">
                    <i class="fas fa-image" id="iconoImagen"></i>
                </label>
            </div>
        </div>

        <div id="descripcionProducto">
            <h2>Agregar descripción del juguete</h2>
            <textarea id="txtDescripcion" name="descripcion" rows="6" placeholder="Ingrese una descripción"></textarea>
        </div>

        <div class="container-publish">
            <div id="TituloPublicacion">
                <h1>Habilidades</h1>
            </div>
            <div class="option">
                <input class="checkbox" type="checkbox" name="habilidad[]" value="Habilidades Motoras">Habilidades
                Motoras</input>
            </div>
            <div class="option">
                <input class="checkbox" type="checkbox" name="habilidad[]" value="Habilidades Cognitivas">Habilidades
                Cognitivas</input>
            </div>
            <div class="option">
                <input class="checkbox" type="checkbox" name="habilidad[]" value="Habilidades Linguísticas">Habilidades
                Linguísticas</input>
            </div><br>
        </div><br>

        <div id="PublicoDes">
            <h1>Edad para el público destinatario</h1>

            <div id="labelEdad">
                <h1>
                    <input type="number" id="edad" name="edad" min="0">
                </h1>
            </div>
        </div>


        <button id="realizarButton" type="submit">Publicar</button>
    </form>

    <script>
        // Obtener referencia al botón
        var realizarButton = document.getElementById('realizarButton');

        // Agregar evento click al botón
        realizarButton.addEventListener('click', function () {
            // Redirigir al usuario a la página de publicar
            window.location.href = 'publicar.php';
        });

    </script>

    <script src="../asset/js/main.js"></script>
    <script src="/PathToy/asset/js/image.js"></script>


</body>