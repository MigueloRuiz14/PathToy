<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PathToy</title>

  <!-- ENLACES EXTERNOS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <!-- ESTILOS -->
  <link rel="stylesheet" href="/PathToy/asset/css/styles.css">
</head>

<body>
  <?php if (empty($_SESSION['usuario'])): ?>
    <nav class="sidebar close">
      <header>
        <div class="image-text">
          <span class="image">
            <!--<img src="logo.png" alt="">-->
          </span>

          <div class="text logo-text">
            <span class="name">PathToy</span>
          </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
      </header>

      <div class="menu-bar">
        <div class="menu">
          <li class="nav-link">
            <a href="/PathToy/index.php">
              <i class='bx bx-home icon'></i>
              <span class="text nav-text">Inicio</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="/PathToy/home/login.php">
              <i class='bx bx-log-in icon'></i>
              <span class="text nav-text">Iniciar Sesión</span>
            </a>
          </li>


          <li class="nav-link">
            <a href="/PathToy/home/signup.php">
              <i class='bx bx-user-plus icon'></i>
              <span class="text nav-text">Registrarse</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="/PathToy/home/AyudaFuera.php">
              <i class='bx bx-question-mark icon'></i>
              <span class="text nav-text">Ayuda</span>
            </a>
          </li>
        </div>
      </div>
    </nav>

  <?php else: ?>
    <nav class="sidebar close">
      <header>
        <div class="image-text">
          <span class="image">
            <!--<img src="logo.png" alt="">-->
          </span>

          <div class="text logo-text">
            <span class="name">PathToy</span>
            <!--span class="profession">New Edge</span-->
          </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
      </header>

      <div class="menu-bar">
        <div class="menu">
          <li class="nav-link">
            <a href="/PathToy/home/panel_control.php">
              <i class='bx bx-home icon'></i>
              <span class="text nav-text">Inicio</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="/PathToy/home/search.php">
              <i class='bx bx-search icon'></i>
              <span class="text nav-text">Buscar</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="/PathToy/home/publicar.php">
              <i class='bx bx-edit icon'></i>
              <span class="text nav-text">Publicar</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="/PathToy/home/private/AyudaDentro.php">
              <i class='bx bx-question-mark icon'></i>
              <span class="text nav-text">Ayuda</span>
            </a>
          </li>
        </div>

        <div class="bottom-content">
          <li class="nav-link">
            <a href="/PathToy/home/private/perfil.php">
              <i class='bx bx-id-card icon'></i>
              <span class="text nav-text">Perfil</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="/PathToy/home/logout.php">
              <i class='bx bx-log-out icon'></i>
              <span class="text nav-text">Cerrar Sesión</span>
            </a>
          </li>
        </div>
      </div>
    </nav>
  <?php endif ?>