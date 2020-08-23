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
                  <label for="nombres">Nombres: </label>
                  <input required type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese el nombre (es)">
                </div>

                <div class="col-lg-6" style="margin: 5px 0;">
                  <label for="apellidopa">Apellido Paterno: </label>
                  <input required type="text" class="form-control" id="apellidopa" name="apellidopa" placeholder="Ingrese el apellido paterno">
                </div>

                <div class="col-lg-6" style="margin: 5px 0;">
                  <label for="apellidoma">Apellido Materno: </label>
                  <input required type="text" class="form-control" id="apellidoma" name="apellidoma" placeholder="Ingrese el apellido materno">
                </div>

                <div class="col-lg-6" style="margin: 5px 0;">
                  <label for="email">Email: </label>
                  <input required type="email" class="form-control" id="email" name="email" placeholder="Ingrese un email">
                </div>

                <div class="col-lg-6" style="margin: 5px 0;">
                  <label for="telefono">Teléfono: </label>
                  <input required type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese un teléfono">
                </div>

                <div class="col-lg-6" style="margin: 5px 0;">
                  <label for="doc_identidad">Documento de Identidad: </label>
                  <input required type="text" class="form-control" id="doc_identidad" name="doc_identidad" placeholder="Ingrese un documento de identidad">
                </div>

                <div class="col-lg-6" style="margin: 5px 0;">
                  <label for="usuario">Usuario: </label>
                  <input required type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese el usuario">
                </div>

                <div class="col-lg-6" style="margin: 5px 0;">
                  <label for="contrasena">Contraseña: </label>
                  <input required type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese la Contraseña">
                </div>

              </div>

              <div style="margin-top: 5px; text-align: center;">
                <button type="submit" name="dashboard" value="admin1-crear" class="btn btn-success">
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