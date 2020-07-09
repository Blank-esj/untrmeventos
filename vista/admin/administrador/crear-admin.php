<?php
include_once '../../plantillas/cabecera-admin.php';
?>

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
            <form role="form" id="guardar-registro" method="post" action="../../../modelo/modelo-admin.php">
 
              <!-- Usuario -->
              <div class="box-body">
                <div class="form-group">
                  <label for="usuario">Usuario: </label>
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresar usuario">
                </div>

                <!-- Nombres -->
                <div class="form-group">
                  <label for="nombre">Nombres</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre completo">
                </div>

                <!-- Apellido paterno -->
                <div class="form-group">
                  <label for="nombre">Nombres</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre completo">
                </div>

                <!-- Apellido materno -->
                <div class="form-group">
                  <label for="nombre">Nombres</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre completo">
                </div>

                <!-- Password -->
                <div class="form-group">
                  <label for="password">Password: </label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Ingresar password">
                </div>

                <!-- Password Verificación -->
                <div class="form-group">
                  <label for="repetir_password">Repetir Password: </label>
                  <input type="password" class="form-control" id="repetir_password" name="repetir_password" placeholder="Repetir password">
                  <span id="resultado_password" class="help-block"></span>
                </div>

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

<?php
include_once '../../plantillas/footer-admin.php';
?>