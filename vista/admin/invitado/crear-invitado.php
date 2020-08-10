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
    <div class="col-md-12">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Invitado</h3>
          </div>
          <div class="box-body">
            <!-- form start -->
            <!-- El tipo de codificación de datos, enctype, DEBE especificarse como sigue -->
            <form method="post" action="dashboard" enctype="multipart/form-data">
              <div class="box-body">
                <div class="row">

                  <!-- Nombres -->
                  <div class="form-group col-md-4">
                    <label for="nombres">Nombres: </label>
                    <input required type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingresar nombres del invitado">
                  </div>

                  <!-- Apellido Paterno -->
                  <div class="form-group col-md-4">
                    <label for="apellidopa">Apellido Paterno: </label>
                    <input required type="text" class="form-control" id="apellidopa" name="apellidopa" placeholder="Ingresar apellido paterno">
                  </div>

                  <!-- Apellido Materno -->
                  <div class="form-group col-md-4">
                    <label for="apellidoma">Apellido Materno: </label>
                    <input required type="text" class="form-control" id="apellidoma" name="apellidoma" placeholder="Ingresar apellido materno">
                  </div>

                  <!-- Email -->
                  <div class="form-group col-md-4">
                    <label for="email">Email: </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingresar un email">
                  </div>

                  <!-- Telefono -->
                  <div class="form-group col-md-4">
                    <label for="telefono">Teléfono: </label>
                    <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Ingresar un teléfono">
                  </div>

                  <!-- Documento de Identidad -->
                  <div class="form-group col-md-4">
                    <label for="doc_identidad">Documento de Identidad: </label>
                    <input type="text" class="form-control" id="doc_identidad" name="doc_identidad" placeholder="Ingresar un documento de identidad">
                  </div>

                  <!-- url_imagen / imagen_invitado -->
                  <div class="form-group col-md-4">
                    <label for="imagen_invitado">Imagen:</label>

                    <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                    <input required type="file" id="imagen_invitado" name="archivo_imagen">
                    <p class="help-block">Agregar la imagen del invitado aquí.</p>
                  </div>

                  <!-- Institución de Procedencia -->
                  <div class="form-group col-md-4">
                    <label for="procedencia">Institución de Procedencia: </label>
                    <input type="text" class="form-control" id="procedencia" name="procedencia" placeholder="Ingresar la Institución de Procedencia">
                  </div>

                  <!-- Fecha de Nacimiento -->
                  <div class="form-group col-md-4">
                    <label for="nacimiento">Fecha de Nacimiento: </label>
                    <input type="date" class="form-control" id="nacimiento" name="nacimiento" placeholder="Ingresar un fecha">
                  </div>

                  <!-- Grado Instruccion -->
                  <?php
                  try {
                    $sql = "SELECT * FROM grado_instruccion";
                    $resultado = $conn->query($sql);
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  } ?>

                  <div class="form-group col-md-4">
                    <label for="grado">Seleccione un Grado</label>
                    <select id="grado" name="grado" class="form-control">
                      <option value="">-- Seleccione --</option>

                      <?php while ($grado = $resultado->fetch_assoc()) { ?>
                        <option value="<?php echo $grado['idgrado_instruccion'] ?>">
                          <?php echo $grado['grado'] ?>
                        </option>
                      <?php } ?>

                    </select>
                  </div>

                  <!-- Sexo -->
                  <div class="form-group col-md-4">
                    <label for="sexo">Sexo: </label>
                    <select id="sexo" name="sexo" class="form-control">
                      <option value="">-- Seleccione --</option>
                      <option value=" H"> Hombre </option>
                      <option value="M"> Mujer </option>
                      <option value="P"> Prefiero no decirlo </option>
                    </select>
                  </div>

                  <!-- Descripcion / Biografia -->
                  <div class="form-group col-md-12">
                    <label for="descripcion">Biografía: </label>
                    <textarea required class="form-control" name="descripcion" id="descripcion" rows="8" placeholder="Presentación profesional"></textarea>
                  </div>

                  <div class="box-footer col-md-12">
                    <button type="submit" class="btn btn-primary" name="dashboard" value="invitado-crear">Agregar</button>
                  </div>
                </div>
              </div> <!-- /.box-body -->
            </form>
          </div> <!-- /.box -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->