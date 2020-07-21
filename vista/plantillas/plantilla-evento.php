<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>UNTRM-Eventos</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="vista/assets/site.webmanifest">
  <link rel="apple-touch-icon" href="vista/assets/img/fisme.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="vista/assets/css/normalize.css">
  <link rel="stylesheet" href="vista/assets/css/all.css">

  <link rel="stylesheet" href="vista/assets/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
  <link rel="stylesheet" href="vista/assets/css/lightbox.min.css">
  <?php
  $archivo = basename($_SERVER['PHP_SELF']);
  $pagina = str_replace(".php", "", $archivo);
  if ($pagina == 'invitados' || $pagina == 'home') {
    echo '
  <link rel="stylesheet" href="vista/assets/css/colorbox.css">';
  }
  ?>
  <link rel="stylesheet" href="vista/assets/css/main.css">
  <meta name="theme-color" content="#fafafa">
  <script src="vista/assets/js/vendor/modernizr-3.7.1.min.js"></script>
  <!-- Bootstrap 4.5 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<?php
include 'vista/plantillas/header-evento.php';
include 'vista/plantillas/nav-evento.php';
if (isset($_GET['ruta'])) {
  if (
    $_GET['ruta'] == 'home' ||
    $_GET['ruta'] == 'galeria' ||
    $_GET['ruta'] == 'calendario' ||
    $_GET['ruta'] == 'invitados' ||
    $_GET['ruta'] == 'registro'
  ) {
    include 'vista/' . $_GET['ruta'] . '.php';
  }
} else {
  include 'vista/home.php';
}
include 'vista/plantillas/footer-evento.php';
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
  window.jQuery || document.write('<script src="vista/assets/js/vendor/jquery-3.4.1.min.js"><\/script>')
</script>
<script src="vista/assets/js/plugins.js"></script>
<script src="vista/assets/js/jquery.animateNumber.min.js"></script>
<script src="vista/assets/js/lightbox-plus-jquery.min.js"></script>
<script src="vista/assets/js/lightbox.min.js"></script>
<?php
$archivo = basename($_SERVER['PHP_SELF']);
$pagina = str_replace(".php", "", $archivo);
if ($pagina == 'invitados' || $pagina == 'index') {
  echo '<script src="vista/assets/js/jquery.colorbox-min.js"></script>';
  echo '<script src="vista/assets/js/jquery.waypoints.min.js"></script>';
}
?>
<script src="vista/controlador/js/cotizador.js"></script>
<script src="vista/assets/js/main.js"></script>

<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
  window.ga = function() {
    ga.q.push(arguments)
  };
  ga.q = [];
  ga.l = +new Date;
  ga('create', 'UA-XXXXX-Y', 'auto');
  ga('set', 'transport', 'beacon');
  ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async></script>
<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script>
<script type="text/javascript">
  window.dojoRequire(["mojo/signup-forms/Loader"], function(L) {
    L.start({
      "baseUrl": "mc.us4.list-manage.com",
      "uuid": "407e005e2f49e226a66d0eaa6",
      "lid": "b4c0599042",
      "uniqueMethods": true
    })
  })
</script>
</body>

</html>