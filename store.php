<?php 
require_once("c://xampp/htdocs/PathToy/controller/homeController.php");
$obj = new homeController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $genero = $_POST['genero'];
    $contraseña = $_POST['contraseña'];
    $confirmarContraseña = $_POST['confirmarContraseña'];
    $error = [];

    if (empty($correo) || empty($nombre) || empty($apellido) || empty($genero) || empty($contraseña) || empty($confirmarContraseña)) {
        $error[] = "Completa todos los campos";
    } elseif ($contraseña !== $confirmarContraseña) {
        $error[] = "Las contraseñas no coinciden";
    } else {
        if ($obj->guardarUsuario($correo, $nombre, $apellido, $genero, $contraseña) === false) {
            $error[] = "El correo ya está registrado";
        } else {
            // Registro exitoso, redirigir a la página de inicio de sesión
            header("Location: login.php");
            exit(); // Terminar el script después de la redirección
        }
    }

    // Codificar y unir los mensajes de error
    $encodedError = urlencode(implode(', ', $error));

    // Redirigir a la página de registro con el mensaje de error
    header("Location: signup.php?error=" . $encodedError);
    exit(); // Terminar el script después de la redirección
}
?>
