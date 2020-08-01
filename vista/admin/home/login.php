<?php
include_once 'modelo/modelo-admins.php';
$adminsModelo = new AdminsModelo();

if ((int)$adminsModelo->cuentaAdmins()[0]['total'] > 0) { ?>

  <body class="hold-transition login-page">

    <div class="login-box">
      <div class="login-logo">
        <a href="home"><b>UNTRM</b> - Eventos</a>
      </div> <!-- /.login-logo -->

      <div class="login-box-body">
        <p class="login-box-msg">Iniciar Sesión aquí</p>

        <form action="" method="post">
          <div class="form-group has-feedback">
            <input required type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input required type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12 align-self-center">
              <input required type="hidden" name="dashboard" value="login">
              <input required type="hidden" name="login-admin" value="1">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>

<?php } else {
  include_once 'vista/admin/administrador/crear-primer-admin.php';
} ?>