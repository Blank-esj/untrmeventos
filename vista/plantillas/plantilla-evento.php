<?php
if (isset($_GET['ruta'])) {
  if ($_GET['ruta'] == 'dashboard') {
    include_once 'vista/plantillas/header-admin.php';
    include 'vista/' . $_GET['ruta'] . '.php';
    include_once 'vista/plantillas/footer-admin.php';
  } elseif (
    $_GET['ruta'] == 'home' ||
    $_GET['ruta'] == 'galeria' ||
    $_GET['ruta'] == 'calendario' ||
    $_GET['ruta'] == 'invitados' ||
    $_GET['ruta'] == 'registro'
  ) {
    include 'vista/plantillas/header-evento.php';
    include 'vista/' . $_GET['ruta'] . '.php';
    include 'vista/plantillas/footer-evento.php';
  }
} else {
  include 'vista/plantillas/header-evento.php';
  include 'vista/home.php';
  include 'vista/plantillas/footer-evento.php';
}
