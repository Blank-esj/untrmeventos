<?php
include_once 'controlador/funciones-admin.php';
echo 'esto aquí';
?>

<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">
      <a href="home"><b>UNTRM</b> - Eventos</a>
    </div> <!-- /.login-logo -->

    <div class="login-box-body">
      <p class="login-box-msg">Iniciar Sesión aquí</p>

      <form action="" method="post">
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
          <div class="col-xs-12 align-self-center">
            <input type="hidden" name="dashboard" value="login">
            <input type="hidden" name="login-admin" value="1">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
          </div> <!-- /.col -->
        </div>
      </form>
    </div> <!-- /.login-box-body -->
  </div> <!-- /.login-box -->
</body>
<?php
//include_once 'controlador/sesiones.php';
?>