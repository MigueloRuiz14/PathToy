<?php
require_once("c://xampp/htdocs/PathToy/controller/homeController.php");
session_start();
$obj = new homeController();
$obj->limpiarcorreo($correo = $_POST['correo']);
$obj->limpiarcadena($contraseña = $_POST['contraseña']);

if (empty($correo) && empty($contraseña)) {
    $error = "<li>Rellena los campos</li>";
    header("Location:login.php?error=" . $error);
    exit();
} elseif (empty($contraseña)) {
    $_SESSION['login_correo'] = $correo;
    $error = "<li>El campo de contraseña está incompleto</li>";
    header("Location:login.php?error=" . $error);
    exit();
}

$bandera = $obj->verificarusuario($correo, $contraseña);

if ($bandera) {
    $_SESSION['usuario'] = $correo;
    unset($_SESSION['login_correo']); // Limpia el valor de correo en la sesión
    header("Location:panel_control.php");
} else {
    $error = "<li>Correo o contraseña incorrecto</li>";
    header("Location:login.php?error=" . $error);
}
?>