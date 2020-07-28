<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Invitados
      <small>Llena el formulario para crear un Invitado.</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-8">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Invitado</h3>
          </div>
          <div class="box-body">
            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo/modelo-invitado.php" enctype="multipart/form-data">
              <div class="box-body">
                <!-- Nombres -->
                <div class="form-group">
                  <label for="nombre_invitado">Nombres: </label>
                  <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Ingresar nombres del invitado">
                </div>

                <!-- Apellido Paterno -->
                <div class="form-group">
                  <label for="apellidopa_invitado">Apellido Paterno: </label>
                  <input type="text" class="form-control" id="apellidopa_invitado" name="apellidopa_invitado" placeholder="Ingresar apellido paterno">
                </div>

                <!-- Apellido Materno -->
                <div class="form-group">
                  <label for="apellidoma_invitado">Apellido Materno: </label>
                  <input type="text" class="form-control" id="apellidoma_invitado" name="apellidoma_invitado" placeholder="Ingresar apellido materno">
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label for="email">Email: </label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ingresar un email">
                </div>

                <!-- Telefono -->
                <div class="form-group">
                  <label for="telefono">Teléfono: </label>
                  <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Ingresar un teléfono">
                </div>

                <!-- Documento de Identidad -->
                <div class="form-group">
                  <label for="doc_identidad">Documento de Identidad: </label>
                  <input type="text" class="form-control" id="doc_identidad" name="doc_identidad" placeholder="Ingresar un documento de identidad">
                </div>

                <!-- Descripcion / Biografia -->
                <div class="form-group">
                  <label for="biografia_invitado">Biografía: </label>
                  <textarea class="form-control" name="biografia_invitado" id="biografia_invitado" rows="8" placeholder="Presentación profesional"></textarea>
                </div>

                <!-- url_imagen / imagen_invitado -->
                <div class="form-group">
                  <label for="imagen_invitado">Imagen:</label>
                  <input type="file" id="imagen_invitado" name="archivo_imagen">
                  <p class="help-block">Agregar la imagen del invitado aquí.</p>
                </div>

                <!-- Institución de Procedencia -->
                <div class="form-group">
                  <label for="institucion_procedencia">Institución de Procedencia: </label>
                  <input type="text" class="form-control" id="institucion_procedencia" name="institucion_procedencia" placeholder="Ingresar la Institución de Procedencia">
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
                    <input type="date" class="form-control" id="nacimiento" name="nacimiento" placeholder="Ingresar un fecha">
                  </div>
                  
                  <!-- Sexo -->
                  <div class="form-group">
                    <label for="sexo">Sexo: </label>
                    <select id="sexo" name="sexo">
                      <option value="">--Seleccione--</option>
                      <option value="H"> Hombre </option>
                      <option value="M"> Mujer </option>
                      <option value="P"> Prefiero no decirlo </option>
                    </select>
                  </div>

                  </div> <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="hidden" name="registro" value="nuevo">
                    <button type="submit" class="btn btn-primary" id="crear_registro">Agregar</button>
                  </div>
            </form>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->