<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>UNTRM-Eventos</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="assets/site.webmanifest">
  <link rel="apple-touch-icon" href="assets/img/fisme.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="assets/css/normalize.css">
  <link rel="stylesheet" href="assets/css/all.css">

  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
  <?php
  $archivo = basename($_SERVER['PHP_SELF']);
  $pagina = str_replace(".php", "", $archivo);
  if ($pagina == 'invitados' || $pagina == 'index') {
    echo '<link rel="stylesheet" href="assets/css/colorbox.css">';
  } else if ($pagina == 'galeria') {
    echo '<link rel="stylesheet" href="assets/css/lightbox.css">';
  }
  ?>
  <link rel="stylesheet" href="assets/css/main.css">
  <meta name="theme-color" content="#fafafa">
  <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
  <!-- Bootstrap 4.5 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body class="<?php echo $pagina; ?>">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <header class="site-header">
    <div class="hero">
      <div class="contenido-header">
        <nav class="redes-sociales">
          <a href="https://www.facebook.com/untrmbagua/?hc_ref=ARSTU3fqVh1PflGUivyDqiLcy8_hBrql_F8oANIYxlHTenBxHaGXNIlzSgnwZrGsBVc&fref=nf&__tn__=kC-R"><i class="fab fa-facebook-square" aria-hidden="true"></i></a>
          <a href="admin/home/login.php"><i class="fas fa-user-cog" aria-hidden="true"></i></a>
        </nav>
        <!--.redes-sociales-->
      </div>
      <!--.contenido-header-->
      <div class="informacion-evento">
        <div class="clearfix">
          <p class="fecha"><i class="fas fa-calendar-alt" aria-hidden="true"></i> 11-15 May</p>
          <p class="ciudad"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Bagua, Peru</p>
        </div>
        <h1 class="nombre-sitio">UNTRM-Eventos</h1>
        <p class="slogan">Curso Taller: DESARROLLO DE TESIS EN <spam> INGENIERÍA</spam>
        </p>
      </div>
      <!--.informacion-evento-->
    </div>
    <!--.hero-->
  </header>
  <!--.site-header-->

  <div class="barra">
    <div class="contenedor clearfix">
      <div class="logo">
        <a href="index.php">
          <img src="assets/img/logo.svg" alt="untrmeventos">
        </a>
      </div>
      <!--.logo-->
      <div class="menu-movil">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!--.menu-movil-->
      <nav class="navegacion-principal clearfix">
        <a class="rounded" href="galeria.php">Galería</a>
        <a class="rounded" href="calendario.php">Calendario</a>
        <a class="rounded" href="invitados.php">Invitados</a>
        <a class="rounded" href="registro.php">Registrate</a>
      </nav>
      <!--.navegacion-principal-->
    </div>
    <!--.contenedor-->
  </div>
  <!--.barra-->