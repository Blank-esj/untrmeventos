<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <!-- Content Header (Page header) -->
    <h1>
      Crear Administradores
      <small>Aquí podrás agregar un nuevo administrador.</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-12">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Administrador</h3>
          </div>

          <!-- form start -->
          <!-- El tipo de codificación de datos, enctype, DEBE especificarse como sigue -->
          <form method="post" action="dashboard" enctype="multipart/form-data">
            <div class="box-body">

              <!-- Nombres -->
              <div class="form-group col-md-4">
                <label for="nombres">Nombres: </label>
                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese el nombre (es)">
              </div>

              <!-- Apellido paterno -->
              <div class="form-group col-md-4">
                <label for="apellidopa">Apellido Paterno: </label>
                <input type="text" class="form-control" id="apellidopa" name="apellidopa" placeholder="Ingrese el apellido paterno">
              </div>

              <!-- Apellido materno -->
              <div class="form-group col-md-4">
                <label for="apellidoma">Apellido Materno: </label>
                <input type="text" class="form-control" id="apellidoma" name="apellidoma" placeholder="Ingrese el apellido materno">
              </div>

              <!-- Email -->
              <div class="form-group col-md-4">
                <label for="email">Email: </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese un email">
              </div>

              <!-- Teléfono -->
              <div class="form-group col-md-4">
                <label for="telefono">Teléfono: </label>
                <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Ingrese un teléfono">
              </div>

              <!-- Documento de identidad -->
              <div class="form-group col-md-4">
                <label for="doc_identidad">Documento de Identidad: </label>
                <input type="text" class="form-control" id="doc_identidad" name="doc_identidad" placeholder="Ingrese un documento de identidad">
              </div>

              <!-- Usuario -->
              <div class="form-group col-md-4">
                <label for="usuario">Usuario: </label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese el usuario">
              </div>

              <!-- Password -->
              <div class="form-group col-md-4">
                <label for="password">Contraseña: </label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese la Contraseña">
              </div>

              <!-- Password Verificación -->
              <div class="form-group col-md-4">
                <label for="repetir_password">Repetir Contraseña: </label>
                <input type="password" class="form-control" id="repetir_password" name="repetir_password" placeholder="Repetir la contraseña">
                <span id="resultado_password" class="help-block"></span>
              </div>

              <!-- Nivel -->
              <div class="form-group col-md-4">
                <label for="nivel">Nivel de usuario: </label>
                <select name="nivel" id="nivel" class="form-control">
                  <option value=""> -- Seleccione -- </option>
                  <option value="0">Usuario estándar</option>
                  <option value="1">Administrador</option>
                </select>
                <span id="resultado_nivel_usuario" class="help-block"></span>
              </div>

            </div> <!-- /.box-body -->

            <div class="box-footer col-md-12">
              <button type="submit" class="btn btn-primary" name="dashboard" value="administrador-crear">Agregar</button>
            </div>

          </form>
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->