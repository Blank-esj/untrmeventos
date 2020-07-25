<?php
error_reporting(E_ALL ^ E_NOTICE);
$cerrar_sesion = $_GET['cerrar_sesion'];
if ($cerrar_sesion) {
  session_destroy();
}
include_once '../../../controlador/funciones-admin.php';
include_once '../../plantillas/header-admin.php';
?>

<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">
      <a href="../../../home"><b>UNTRM</b> - Eventos</a>
    </div> <!-- /.login-logo -->

    <div class="login-box-body">
      <p class="login-box-msg">Iniciar Sesión aquí</p>

      <form name="login-admin-form" id="login-admin" method="post" action="../../../controlador/login-admin.php">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <input type="hidden" name="login-admin" value="1">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
          </div> <!-- /.col -->
        </div>
      </form>
    </div> <!-- /.login-box-body -->
  </div> <!-- /.login-box -->
</body>
<?php
include_once '../../plantillas/footer-admin.php';
?>