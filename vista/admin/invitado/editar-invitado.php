<?php
$id = $_GET['id'];
/*if (!filter_var($id, FILTER_VALIDATE_INT)) {
  die("Error el id: {$id} no es un entero.");
}*/
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
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Editar Invitado</h3>
          </div>
          <div class="box-body">
            <?php
            $sql = "SELECT * FROM v_invitado WHERE idpersona = $id ";
            $resultado = $conn->query($sql);
            $invitado = $resultado->fetch_assoc();
            ?>
            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="../../../modelo/modelo-invitado.php" enctype="multipart/form-data">
              <div class="box-body">
                <!-- Nombres -->
                <div class="form-group">
                  <label for="nombre_invitado">Nombres: </label>
                  <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Ingresa nombre de invitado" value="<?php echo $invitado['nombres']; ?>">
                </div>

                <!-- Apellido Paterno -->
                <div class="form-group">
                  <label for="apellidopa_invitado">Apellido Paterno: </label>
                  <input type="text" class="form-control" id="apellidopa_invitado" name="apellidopa_invitado" placeholder="Ingresa apellido paterno" value="<?php echo $invitado['apellidopa']; ?>">
                </div>

                <!-- Apellido Materno -->
                <div class="form-group">
                  <label for="apellidoma_invitado">Apellido Materno: </label>
                  <input type="text" class="form-control" id="apellidoma_invitado" name="apellidoma_invitado" placeholder="Ingresa apellido materno" value="<?php echo $invitado['apellidoma']; ?>">
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label for="email">Apellido Materno: </label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa un email" value="<?php echo $invitado['email']; ?>">
                </div>
                
                <!-- Teléfono -->
                <div class="form-group">
                  <label for="telefono">Apellido Materno: </label>
                  <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Ingresa un teléfono" value="<?php echo $invitado['telefono']; ?>">
                </div>

                <!-- Documento de Identidad -->
                <div class="form-group">
                  <label for="doc_identidad">Documento de Identidad: </label>
                  <input type="number" class="form-control" id="doc_identidad" name="doc_identidad" placeholder="Ingresa un documento" value="<?php echo $invitado['doc_identidad']; ?>">
                </div>
                
                <!-- Descripción / Biografía -->
                <div class="form-group">
                  <label for="biografia_invitado">Biografía: </label>
                  <textarea class="form-control" name="biografia_invitado" id="biografia_invitado" rows="8" placeholder="Presentación profesional"><?php echo $invitado['descripcion']; ?></textarea>
                </div>

                <!-- url_imagen -->
                <div class="form-group">
                  <label for="imagen_actual">Imagen Actual:</label>
                  <br>
                  <img src="../img/invitados/<?php echo $invitado['url_imagen']; ?>" width="200">
                </div>

                <!-- Nueva url_imagen -->
                <div class="form-group">
                  <label for="imagen_invitado">Imagen:</label>
                  <input type="file" id="imagen_invitado" name="archivo_imagen">
                  <p class="help-block">Agregue la nueva imagen del invitado aquí.</p>
                </div>

                <!-- Institucion de Procedencia -->
                <div class="form-group">
                  <label for="institucion_procedencia">Institucion de Procedencia: </label>
                  <input type="date" class="form-control" id="institucion_procedencia" name="institucion_procedencia" placeholder="Ingresa una institución" value="<?php echo $invitado['institucion_procedencia']; ?>">
                </div>

                <!-- Grado Instruccion -->
                <?php
                  try {
                    $sql = "SELECT * FROM grado_instruccion";
                    $resultado = $conn->query($sql);
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }

                  while ($grado = $resultado->fetch_assoc()) {
                  ?>
                    <div class="orden">
                      <label for="grado_instruccion">Seleccione un Grado</label> <br>
                      <select id="grado_instruccion" name="grado_instruccion">
                        <option value="">--Seleccione--</option>
                        <option value="<? echo $grado['idgrado_instruccion'] ?>" >
                          <? echo $grado['grado'] ?>
                        </option>
                      </select>
                    <?php
                  }
                ?>

                <!-- Fecha de Nacimiento -->
                <div class="form-group">
                  <label for="nacimiento">Fecha de Nacimiento: </label>
                  <input type="date" class="form-control" id="nacimiento" name="nacimiento" placeholder="Ingresa una fecha" value="<?php echo $invitado['nacimiento']; ?>">
                </div>
              </div> <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="registro" value="actualizar">
                <input type="hidden" name="id_registro" value="<?php echo $invitado['idpersona']; ?>">
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