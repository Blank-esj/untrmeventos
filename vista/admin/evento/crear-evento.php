<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Temas
      <small>Aquí podrás agregar un nuevo tema.</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-12">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Tema</h3>
          </div>

          <!-- form start -->
          <form method="post" action="dashboard">
            <div class="box-body">

              <!-- Nombre -->
              <div class="form-group col-md-9">
                <label for="nombre_evento">Nombre: </label>
                <input required type="text" class="form-control" id="nombre_evento" name="nombre_evento" placeholder="Ingrese el nombre">
              </div>

              <!-- Clave -->
              <div class="form-group col-md-3">
                <label for="clave">Clave: </label>
                <input required type="text" class="form-control" id="clave" name="clave" placeholder="Ingrese una clave">
              </div>

              <!-- Categoría -->
              <div class="form-group col-md-6">
                <label for="categoria">Categoría: </label>
                <select required name="categoria_evento" class="form-control">
                  <option value="0"> -- Seleccione -- </option>
                  <?php
                  try {
                    $sql = "SELECT * FROM categoria_evento ";
                    $resultado = $conn->query($sql);
                    while ($cat_evento = $resultado->fetch_assoc()) { ?>
                      <option value="<?php echo $cat_evento['id_categoria']; ?>">
                        <?php echo $cat_evento['cat_evento']; ?>
                      </option>
                  <?php }
                  } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                  } ?>
                </select>
              </div>

              <!-- Invitado -->
              <div class="form-group col-md-6">
                <label for="nombre">Invitado: </label>
                <select required name="invitado" class="form-control">
                  <option value="0"> -- Seleccione -- </option>
                  <?php
                  try {
                    $sql = "SELECT idpersona, nombre_completo FROM v_invitado";
                    $resultado = $conn->query($sql);
                    if ($resultado != false) {
                      while ($invitado = $resultado->fetch_assoc()) { ?>
                        <option value="<?php echo $invitado['idpersona']; ?>">
                          <?php echo $invitado['nombre_completo']; ?>
                        </option>
                  <?php }
                    }
                  } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                  }
                  ?>
                </select>
              </div>

              <!-- Date -->
              <div class="form-group col-md-6">
                <label for="fecha">Fecha:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="fecha" name="fecha_evento" placeholder="-- Seleccione --">
                </div> <!-- /.input group -->
              </div> <!-- /.form group -->

              <!-- Hora -->
              <div class="form-group col-md-6">
                <label for="timepicker">Hora:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock"></i>
                  </div>
                  <input type="text" class="form-control timepicker" id="hora" name="hora_evento" placeholder="-- Seleccione --">
                </div> <!-- /.input group -->
              </div> <!-- /.form group -->

            </div> <!-- /.box-body -->
            <div class="box-footer col-md-12">
              <input type="hidden" name="dashboard" value="evento-crear">
              <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
          </form>

        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->