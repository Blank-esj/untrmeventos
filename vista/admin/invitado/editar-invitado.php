<?php
$id = openssl_decrypt($_POST['id'], COD, KEY);
if (!filter_var($id, FILTER_VALIDATE_INT)) {
  die("Error el id: {$id} no es un entero.");
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Invitados
      <small>Aquí podrás modificar al invitado seleccionado.</small>
    </h1>
  </section>

  <div class="row">
    <div class="col-md-12">
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Editar Invitado</h3>
          </div>

          <?php
          $resul_inv = $conn->query("SELECT * FROM invitado WHERE idpersona = $id");
          $invitado = $resul_inv->fetch_assoc();

          $resul_per = $conn->query("SELECT * FROM persona WHERE idpersona = $id");
          $persona = $resul_per->fetch_assoc();
          ?>
          <!-- form start -->
          <form method="post" action="dashboard" enctype="multipart/form-data">
            <div class="box-body">

              <!-- Nombres -->
              <div class="form-group col-md-4">
                <label for="nombres">Nombres: </label>
                <input required type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese el nombre (es)" value="<?php echo $persona['nombres']; ?>">
              </div>

              <!-- Apellido Paterno -->
              <div class="form-group col-md-4">
                <label for="apellidopa">Apellido Paterno: </label>
                <input required type="text" class="form-control" id="apellidopa" name="apellidopa" placeholder="Ingrese el apellido paterno" value="<?php echo $persona['apellidopa']; ?>">
              </div>

              <!-- Apellido Materno -->
              <div class="form-group col-md-4">
                <label for="apellidoma">Apellido Materno: </label>
                <input required type="text" class="form-control" id="apellidoma" name="apellidoma" placeholder="Ingrese el apellido materno" value="<?php echo $persona['apellidoma']; ?>">
              </div>

              <!-- Email -->
              <div class="form-group col-md-4">
                <label for="email">Email: </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese un email" value="<?php echo $persona['email']; ?>">
              </div>

              <!-- Teléfono -->
              <div class="form-group col-md-4">
                <label for="telefono">Teléfono: </label>
                <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Ingrese un teléfono" value="<?php echo $persona['telefono']; ?>">
              </div>

              <!-- Documento de Identidad -->
              <div class="form-group col-md-4">
                <label for="doc_identidad">Documento de Identidad: </label>
                <input type="number" class="form-control" id="doc_identidad" name="doc_identidad" placeholder="Ingrese un documento de identidad" value="<?php echo $persona['doc_identidad']; ?>">
              </div>

              <!-- url_imagen -->
              <div class="form-group col-md-4">
                <label for="imagen_actual">Imagen Actual:</label>
                <br>
                <img src="<?php echo DIR_IMG_INVITADO . $invitado['url_imagen']; ?>" width="200">
              </div>

              <!-- Nueva url_imagen -->
              <div class="form-group col-md-4">
                <label for="imagen_invitado">Imagen:</label>
                <input type="file" id="imagen_invitado" name="archivo_imagen">
                <h6 class="help-block">Agregue la nueva imagen del invitado aquí.</h6>
              </div>

              <!-- Institucion de Procedencia -->
              <div class="form-group col-md-4">
                <label for="procedencia">Institucion de Procedencia: </label>
                <input type="text" class="form-control" id="procedencia" name="procedencia" placeholder="Ingrese una institución de procedencia" value="<?php echo $invitado['institucion_procedencia']; ?>">
              </div>

              <!-- Fecha de Nacimiento -->
              <div class="form-group col-md-4">
                <label for="nacimiento">Fecha de Nacimiento: </label>
                <input type="date" class="form-control" id="nacimiento" name="nacimiento" placeholder="Ingrese una fecha" value="<?php echo $invitado['nacimiento']; ?>">
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
                <label for="grado">Grado Académico: </label>
                <select id="grado" name="grado" class="form-control">
                  <option value="">--Seleccione--</option>

                  <?php while ($grado = $resultado->fetch_assoc()) { ?>
                    <option <?php echo $grado['idgrado_instruccion'] == $invitado['idgrado_instruccion'] ? "selected" : "" ?> value="<?php echo $grado['idgrado_instruccion'] ?>">
                      <?php echo $grado['grado'] ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <!-- Sexo -->
              <div class="form-group col-md-4">
                <label for="sexo">Sexo: </label>
                <select id="sexo" name="sexo" class="form-control">
                  <option value="">--Seleccione--</option>
                  <option <?php echo "H" == $invitado['sexo'] ? "selected" : "" ?> value="H"> Hombre </option>
                  <option <?php echo "M" == $invitado['sexo'] ? "selected" : "" ?> value="M"> Mujer </option>
                  <option <?php echo "P" == $invitado['sexo'] ? "selected" : "" ?> value="P"> Prefiero no decirlo </option>
                </select>
              </div>

              <!-- Descripción / Biografía -->
              <div class="form-group col-md-12">
                <label for="descripcion">Biografía: </label>
                <textarea required class="form-control" name="descripcion" id="descripcion" rows="8" placeholder="Ingrese una descripción profesional"><?php echo $invitado['descripcion']; ?></textarea>
              </div>
            </div> <!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="id" value="<?php echo openssl_encrypt($id, COD, KEY); ?>">
              <button type="submit" name="dashboard" value="invitado-editar1" class="btn btn-primary">Actualizar</button>
            </div>

          </form>

        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->