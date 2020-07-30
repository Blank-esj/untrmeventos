<?php
include_once 'controlador/util/bd_conexion_pdo.php';
include_once 'modelo/admins.php';
$connPDO = (new Conexion())->conectarPDO();
$adminsModelo = new Admins();

include_once 'controlador/admins.php';

if ((int)$adminsModelo->cuentaAdmins($connPDO)[0]['total'] > 0) { ?>

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
            <input required type="password" class="form-control" id="password" name="password" placeholder="Password">
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

<?php } else { ?>

  <body class="hold-transition login-page">
    <div class="container-fluid" style="margin-top: 10px;">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <div class="panel panel-primary rounded">
            <div class="panel-heading">
              Registro del primer Administrador
            </div>
            <div class="panel-body">

              <form action="" method="post">

                <div class="row">

                  <div class="col-lg-6" style="margin: 5px 0;">
                    <label for="nombres">Nombres</label>
                    <input required type="text" class="form-control" id="nombres" name="nombres">
                  </div>

                  <div class="col-lg-6" style="margin: 5px 0;">
                    <label for="apellidopa">Apellido Paterno</label>
                    <input required type="text" class="form-control" id="apellidopa" name="apellidopa">
                  </div>

                  <div class="col-lg-6" style="margin: 5px 0;">
                    <label for="apellidoma">Apellido Materno</label>
                    <input required type="text" class="form-control" id="apellidoma" name="apellidoma">
                  </div>

                  <div class="col-lg-6" style="margin: 5px 0;">
                    <label for="email">Email</label>
                    <input required type="email" class="form-control" id="email" name="email">
                  </div>

                  <div class="col-lg-6" style="margin: 5px 0;">
                    <label for="telefono">Teléfono</label>
                    <input required type="text" class="form-control" id="telefono" name="telefono">
                  </div>

                  <div class="col-lg-6" style="margin: 5px 0;">
                    <label for="doc_identidad">Documento de Identidad</label>
                    <input required type="text" class="form-control" id="doc_identidad" name="doc_identidad">
                  </div>

                  <div class="col-lg-6" style="margin: 5px 0;">
                    <label for="usuario">Usuario</label>
                    <input required type="text" class="form-control" id="usuario" name="usuario">
                  </div>

                  <div class="col-lg-6" style="margin: 5px 0;">
                    <label for="contrasena">Contraseña</label>
                    <input required type="password" class="form-control" id="contrasena" name="contrasena">
                  </div>

                </div>

                <div style="margin-top: 5px; text-align: center;">
                  <button type="submit" name="dashboard" value="<?php echo openssl_encrypt("admin1-crear", COD, KEY) ?>" class="btn btn-success">
                    <i class="fa fa-save"></i>
                    Guardar
                  </button>
                </div>

            </div>

            </form>

          </div>
        </div>
        <div class="col-lg-2"></div>
      </div>
    </div>
  </body>

<?php } ?>