<?php
//CapEscribe unra de datos para proceder con la consulta SQL y llenar el formulario.
$id = $_GET['id'];
if (!filter_var($id, FILTER_VALIDATE_INT)) { //Valida que el id sea entero. Negamos para valida si alguien envia letras
  die("Error!");
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Administrador
      <small> Puedes modificar los datos del Administrador aquí.</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-8">
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Editar Administrador</h3>
          </div>
          <div class="box-body">
            <?php
            $sql = "SELECT * FROM v_admins WHERE idpersona = {$id} ";
            $resultado = $conn->query($sql);
            $admin = $resultado->fetch_assoc();
            ?>
            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="../../../modelo/modelo-admin.php">
              <div class="box-body">

                <!-- Nombres -->
                <div class="form-group">
                  <label for="nombre">Nombres: </label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese los nombres" value="<?php echo $admin['nombres']; ?>">
                </div>

                <!-- Apellido Paterno -->
                <div class="form-group">
                  <label for="apellidopa">Apellido Paterno: </label>
                  <input type="text" class="form-control" id="apellidopa" name="apellidopa" placeholder="Ingrese el apellido paterno" value="<?php echo $admin['apellidopa']; ?>">
                </div>

                <!-- Apellido Materno -->
                <div class="form-group">
                  <label for="apellidoma">Apellido Materno: </label>
                  <input type="text" class="form-control" id="apellidoma" name="apellidoma" placeholder="Escribe el apellido materno" value="<?php echo $admin['apellidoma']; ?>">
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label for="email">Email: </label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el email" value="<?php echo $admin['email']; ?>">
                </div>

                <!-- Teléfono -->
                <div class="form-group">
                  <label for="telefono">Teléfono: </label>
                  <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el teléfono o celular" value="<?php echo $admin['telefono']; ?>">
                </div>

                <!-- Documento de identidad -->
                <div class="form-group">
                  <label for="doc_ident">Documento de Identidad: </label>
                  <input type="text" class="form-control" id="doc_ident" name="doc_ident" placeholder="Ingrese el documento de identidad" value="<?php echo $admin['nombre']; ?>">
                </div>

                <!-- Usuario -->
                <div class="form-group">
                  <label for="usuario">Usuario: </label>
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo $admin['usuario']; ?>">
                </div>

                <!-- Password -->
                <div class="form-group">
                  <label for="password">Password: </label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password para iniciar sesion">
                </div>

                <!-- Nivel -->
                <div class="form-group">
                  <label for="nivel">Nivel de usuario </label>
                  <select name="nivel" id="nivel" class="form-control" value="<?php echo $admin['nivel']; ?>">
                    <option value=""> -- Seleccione -- </option>
                    <option value="0">Usuario estándar</option>
                    <option value="1">Administrador</option>
                  </select>
                  <span id="resultado_nivel_usuario" class="help-block"></span>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="registro" value="actualizar">
                <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->