<?php
  $id = $_GET['id'];
  if(!filter_var($id, FILTER_VALIDATE_INT)) {
    die("Error");
  }
  include_once '../../plantillas/cabecera-admin.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Invitados
        <small>Puedes modificar los datos de los Invitados aquí.</small>
      </h1>
    </section>
    <div class="row">
      <div class="col-md-8">      
        <section class="content"> <!-- Main content -->
          <div class="box"> <!-- Default box -->
            <div class="box-header with-border">
              <h3 class="box-title">Editar Invitado</h3>
            </div>
            <div class="box-body">
              <?php
                $sql = "SELECT * FROM invitado WHERE id_invitado = $id ";
                $resultado = $conn->query($sql);
                $invitado = $resultado->fetch_assoc();
              ?> 
              <!-- form start -->
              <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="../../../modelo/modelo-invitado.php" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <label for="nombre_invitado">Nombres: </label>
                    <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Ingresa nombre de invitado" value="<?php echo $invitado['nombre_invitado']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="apellidopa_invitado">Apellido Paterno: </label>
                    <input type="text" class="form-control" id="apellidopa_invitado" name="apellidopa_invitado" placeholder="Ingresa apellido paterno" value="<?php echo $invitado['apellidopa_invitado']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="apellidoma_invitado">Apellido Materno: </label>
                    <input type="text" class="form-control" id="apellidoma_invitado" name="apellidoma_invitado" placeholder="Ingresa apellido materno" value="<?php echo $invitado['apellidoma_invitado']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="biografia_invitado">Biografía: </label>
                    <textarea class="form-control" name="biografia_invitado" id="biografia_invitado" rows="8" placeholder="Presentación profesional"><?php echo $invitado['descripcion']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="imagen_actual">Imagen Actual:</label>
                    <br>
                    <img src="../img/invitados/<?php echo $invitado['url_imagen']; ?>" width="200">
                  </div>
                  <div class="form-group">
                    <label for="imagen_invitado">Imagen:</label>
                    <input type="file" id="imagen_invitado" name="archivo_imagen">
                    <p class="help-block">Agregue la nueva imagen del invitado aquí.</p>
                  </div>
                </div> <!-- /.box-body -->
                
                <div class="box-footer">
                  <input type="hidden" name="registro" value="actualizar">
                  <input type="hidden" name="id_registro" value="<?php echo $invitado['id_invitado']; ?>">
                  <button type="submit" class="btn btn-primary" id="crear_registro">Agregar</button>
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