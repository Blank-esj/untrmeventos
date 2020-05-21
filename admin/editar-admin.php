<?php
  include_once 'funciones/sesiones.php';
  include_once 'templates/header.php';
  include_once 'funciones/funciones.php';
  //Captura de datos para proceder con la consulta SQL y llenar el formulario.
  $id = $_GET['id'];
  if(!filter_var($id, FILTER_VALIDATE_INT)) { //Valida que el id sea entero. Negamos para valida si alguien envia letras
    die("Error!");
  }
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
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
              $sql = "SELECT * FROM admins WHERE id_admin = {$id} ";
              $resultado = $conn->query($sql);
              $admin = $resultado->fetch_assoc();
            ?>
            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-admin.php">
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Usuario: </label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo $admin['usuario']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombres y Apellidos: </label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre completo" value="<?php echo $admin['nombre']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password: </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password para iniciar sesion">
                  </div>
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
<?php
  include_once 'templates/footer.php';
?>