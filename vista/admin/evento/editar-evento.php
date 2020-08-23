<?php
$id = openssl_decrypt($_POST['id'], COD, KEY);
if (!filter_var($id, FILTER_VALIDATE_INT)) :
  die("Error");
else :
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Temas
        <small>Aquí podrás modificar el tema seleccionado.</small>
      </h1>
    </section>
    <div class="row">
      <div class="col-md-12">
        <section class="content">
          <!-- Main content -->
          <div class="box">
            <!-- Default box -->
            <div class="box-header with-border">
              <h3 class="box-title">Editar Tema</h3>
            </div>

            <?php
            $sql = "SELECT * FROM evento WHERE id_evento = $id ";
            $resultado = $conn->query($sql);
            $evento = $resultado->fetch_assoc();
            ?>
            <!-- form start -->
            <form method="post" action="dashboard">
              <div class="box-body">
                <!-- Nombre -->
                <div class="form-group col-md-9">
                  <label for="nombre_evento">Nombre: </label>
                  <input required type="text" class="form-control" id="nombre_evento" name="nombre_evento" placeholder="Ingrese el título del evento" value="<?php echo $evento['nombre_evento']; ?>">
                </div>

                <!-- Clave -->
                <div class="form-group col-md-3">
                  <label for="clave">Clave: </label>
                  <input required type="text" class="form-control" id="clave" name="clave" placeholder="Ingresar una clave para el evento" value="<?php echo $evento['clave']; ?>">
                </div>

                <!-- Categoría -->
                <div class="form-group col-md-6">
                  <label for="categoria">Categoría: </label>
                  <select name="categoria_evento" class="form-control">
                    <option value="0"> -- Seleccione -- </option>
                    <?php
                    try {
                      $categoria_actual = $evento['id_cat_evento'];
                      $sql = "SELECT * FROM categoria_evento ";
                      $resultado = $conn->query($sql);
                      while ($cat_evento = $resultado->fetch_assoc()) {
                        if ($cat_evento['id_categoria'] == $categoria_actual) { ?>
                          <option value="<?php echo $cat_evento['id_categoria']; ?>" selected>
                            <?php echo $cat_evento['cat_evento']; ?>
                          </option>
                        <?php } else { ?>
                          <option value="<?php echo $cat_evento['id_categoria']; ?>">
                            <?php echo $cat_evento['cat_evento']; ?>
                          </option>
                    <?php }
                      }
                    } catch (Exception $e) {
                      echo "Error: " . $e->getMessage();
                    }
                    ?>
                  </select>
                </div>

                <!-- Invitado -->
                <div class="form-group col-md-6">
                  <label for="nombre">Invitado: </label>
                  <select name="invitado" class="form-control">
                    <option value="0"> -- Seleccione -- </option>
                    <?php
                    try {
                      $invitado_actual = $evento['id_inv'];
                      $sql = "SELECT idpersona, nombre_completo FROM v_invitado";
                      $resultado = $conn->query($sql);
                      while ($invitado = $resultado->fetch_assoc()) {  ?>
                        <option value="<?php echo $invitado['idpersona']; ?>" <?php echo ($invitado['idpersona'] == $invitado_actual) ? "selected" : "" ?>>
                          <?php echo $invitado['nombre_completo']; ?>
                        </option>
                    <?php }
                    } catch (Exception $e) {
                      echo "Error: " . $e->getMessage();
                    }
                    ?>
                  </select>
                </div>

                <!-- Date -->
                <div class="form-group col-md-6">
                  <label for="datepicker">Fecha:</label>
                  <?php
                  $fecha = $evento['fecha_evento'];
                  $fecha_formato = date('m/d/Y', strtotime($fecha));
                  ?>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="fecha" name="fecha_evento" value="<?php echo $fecha_formato; ?>">
                  </div> <!-- /.input group -->
                </div> <!-- /.form group -->

                <!-- Hora -->
                <div class="form-group col-md-6">
                  <label for="timepicker">Hora:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <?php
                    $hora = $evento['hora_evento'];
                    $hora_formato = date('h:i a', strtotime($hora));
                    ?>
                    <input type="text" class="form-control timepicker" name="hora_evento" value="<?php echo $hora_formato; ?>">
                  </div> <!-- /.input group -->
                </div> <!-- /.form group -->
              </div>

              <div class="box-footer">
                <input type="hidden" name="id" value="<?Php echo openssl_encrypt($id, COD, KEY); ?>">
                <button type="submit" name="dashboard" value="evento-editar1" class="btn btn-primary">Actualizar</button>
              </div>
            </form>


          </div> <!-- /.box-body -->

        </section> <!-- /.content -->
      </div> <!-- /.box -->
    </div>
  </div> <!-- /.content-wrapper -->
<?php
endif;
?>