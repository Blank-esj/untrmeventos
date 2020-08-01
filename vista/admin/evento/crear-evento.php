<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Eventos
      <small>Llena el formulario para crear un Evento.</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-12">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Evento</h3>
          </div>
          <div class="box-body">
            <!-- form start -->
            <form method="post" action="dashboard">
              <div class="box-body">

                <div class="row">

                  <div class="form-group col-md-9">
                    <label for="nombre_evento">Título Evento: </label>
                    <input required type="text" class="form-control" id="nombre_evento" name="nombre_evento" placeholder="Ingresar título del evento">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="clave">Clave: </label>
                    <input required type="text" class="form-control" id="clave" name="clave" placeholder="Ingresar una clave para el evento">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="categoria">Categoría Evento: </label>
                    <select required name="categoria_evento" class="form-control seleccionar">
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

                  <div class="form-group col-md-6">
                    <label for="nombre">Invitado o Ponente del Evento: </label>
                    <select required name="invitado" class="form-control seleccionar">
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
                    <label for="datepicker">Fecha Evento:</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input required type="text" class="form-control pull-right" id="fecha" name="fecha_evento">
                    </div> <!-- /.input group -->
                  </div> <!-- /.form group -->

                  <!-- time Picker -->
                  <div class="col-md-6 ">
                    <div class="bootstrap-timepicker ">
                      <div class="form-group">
                        <label>Hora Evento:</label>
                        <div class="input-group">
                          <input required type="text" class="form-control timepicker" name="hora_evento">
                          <div class="input-group-addon">
                            <i class="fa fa-clock"></i>
                          </div>
                        </div> <!-- /.input group -->
                      </div> <!-- /.form group -->
                    </div>
                  </div>

                </div>

              </div> <!-- /.box-body -->
              <div class="box-footer col-md-12">
                <input type="hidden" name="dashboard" value="evento-crear">
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div>
            </form>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->