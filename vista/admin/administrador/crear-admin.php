<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <!-- Content Header (Page header) -->
    <h1>
      Crear Administrador
      <small>Llena el formulario para crear un Administrador o Usuario.</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-8">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Administrador</h3>
          </div>
          <div class="box-body">
            <!-- form start -->
            <form role="form" id="guardar-registro" method="post" action="modelo/modelo-admin.php">

              <div class="box-body">
                <!-- Nombres -->
                <div class="form-group">
                  <label for="nombre">Nombres: </label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese los nombres">
                </div>

                <!-- Apellido paterno -->
                <div class="form-group">
                  <label for="apellidopa">Apellido Paterno: </label>
                  <input type="text" class="form-control" id="apellidopa" name="apellidopa" placeholder="Ingrese el apellido paterno">
                </div>

                <!-- Apellido materno -->
                <div class="form-group">
                  <label for="apellidoma">Apellido Materno: </label>
                  <input type="text" class="form-control" id="apellidoma" name="apellidoma" placeholder="Ingrese el apellido materno">
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label for="email">Email: </label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el email">
                </div>

                <!-- Teléfono -->
                <div class="form-group">
                  <label for="telefono">Teléfono: </label>
                  <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el teléfono o celular">
                </div>

                <!-- Documento de identidad -->
                <div class="form-group">
                  <label for="doc_ident">Documento de Identidad: </label>
                  <input type="text" class="form-control" id="doc_ident" name="doc_ident" placeholder="Ingrese el documento de identidad">
                </div>

                <!-- Usuario -->
                <div class="form-group">
                  <label for="usuario">Usuario: </label>
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese el usuario">
                </div>

                <!-- Password -->
                <div class="form-group">
                  <label for="password">Password: </label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese el password">
                </div>

                <!-- Password Verificación -->
                <div class="form-group">
                  <label for="repetir_password">Repetir Password: </label>
                  <input type="password" class="form-control" id="repetir_password" name="repetir_password" placeholder="Repetir password">
                  <span id="resultado_password" class="help-block"></span>
                </div>

                <!-- Nivel -->
                <div class="form-group">
                  <label for="nivel">Nivel de usuario </label>
                  <select name="nivel" id="nivel" class="form-control">
                    <option value=""> -- Seleccione -- </option>
                    <option value="0">Usuario estándar</option>
                    <option value="1">Administrador</option>
                  </select>
                  <span id="resultado_nivel_usuario" class="help-block"></span>
                </div>
              </div> <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-primary" id="crear_registro_admin">Agregar</button>
              </div>

            </form>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->