<?php
require_once('C://xampp/htdocs/PathToy/view/header.php');
if (!empty($_SESSION['usuario'])) {
    header("Location:panel_control.php");
}
?> 

<div class="fondo-login">
    <div class="icon">
        <a href="/PathToy/index.php">
            <i class="fa-solid fa-house back-icon"> Inicio</i>
        </a>
    </div>
    <div class="titulo">
        Iniciar sesión
    </div>
    <!--formulario de login-->

    <form action="verificar.php" method="POST" class="col-8 col-md-3  login">
        <div class="md-3">
            <label for="exampleInputEmail1" class="form-label">Correo</label>
            <input type="email" name="correo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo isset($_SESSION['login_correo']) ? $_SESSION['login_correo'] : ''; ?>">
        </div>
        <div class="md-3">
            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
            <div class="box-eye">
                <button type="button" onclick="mostrarcontraseña('password', 'eyepassword')">
                    <i id="eyepassword" class="fa-solid fa-eye changePassword"></i>
                </button>
            </div>
            <input type="password" name="contraseña" class="form-control" id="password">
        </div><br>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?= urldecode($_GET['error']) ?>
            </div>
        <?php endif; ?>
        <div class="row p-3">
            <div class="d-grid">
                <button type="submit" class=" btn btn-dark">Ingresar</button>
            </div>
        </div>
    </form>
    <div class="col-8 col-md-3 mt-3 login">
        ¿No tienes una cuenta? <a href="signup.php">Registrate</a>
    </div>

</div>

<script>
    // Esperar a que se cargue el DOM
    document.addEventListener("DOMContentLoaded", function () {
        const errorMessage = document.querySelector(".alert");
        if (errorMessage.textContent.trim() !== "") {
            errorMessage.style.display = "block"; // Mostrar el mensaje de error

            // Configurar un temporizador para ocultar el mensaje después de 3 segundos
            setTimeout(function () {
                errorMessage.style.display = "none"; // Ocultar el mensaje de error
                
                // Limpiar el parámetro de error de la URL
                history.replaceState({}, document.title, window.location.href.split('?')[0]);

            }, 2000); // 3000 milisegundos = 3 segundos
        }
    });
</script>

<?php require_once('C://xampp/htdocs/PathToy/view/footer.php'); ?>