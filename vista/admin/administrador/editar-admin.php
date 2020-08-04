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
      Editar Administrador
      <small> Puedes modificar los datos del Administrador aquí.</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-12">
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Editar Administrador</h3>
          </div>
          <div class="box-body">
            <?php

            $resul_adm = $conn->query("SELECT * FROM admins WHERE idpersona = $id");
            $admin = $resul_adm->fetch_assoc();

            $resul_per = $conn->query("SELECT * FROM persona WHERE idpersona = $id");
            $persona = $resul_per->fetch_assoc();

            ?>
            <!-- form start -->
            <form method="post" action="dashboard" enctype="multipart/form-data">
              <div class="box-body">

                <!-- Nombres -->
                <div class="form-group col-md-4">
                  <label for="nombre">Nombres: </label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese los nombres" value="<?php echo $persona['nombres']; ?>">
                </div>

                <!-- Apellido Paterno -->
                <div class="form-group col-md-4">
                  <label for="apellidopa">Apellido Paterno: </label>
                  <input type="text" class="form-control" id="apellidopa" name="apellidopa" placeholder="Ingrese el apellido paterno" value="<?php echo $persona['apellidopa']; ?>">
                </div>

                <!-- Apellido Materno -->
                <div class="form-group col-md-4">
                  <label for="apellidoma">Apellido Materno: </label>
                  <input type="text" class="form-control" id="apellidoma" name="apellidoma" placeholder="Escribe el apellido materno" value="<?php echo $persona['apellidoma']; ?>">
                </div>

                <!-- Email -->
                <div class="form-group col-md-4">
                  <label for="email">Email: </label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el email" value="<?php echo $persona['email']; ?>">
                </div>

                <!-- Teléfono -->
                <div class="form-group col-md-4">
                  <label for="telefono">Teléfono: </label>
                  <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el teléfono o celular" value="<?php echo $persona['telefono']; ?>">
                </div>

                <!-- Documento de identidad -->
                <div class="form-group col-md-4">
                  <label for="doc_ident">Documento de Identidad: </label>
                  <input type="text" class="form-control" id="doc_ident" name="doc_ident" placeholder="Ingrese el documento de identidad" value="<?php echo $persona['doc_identidad']; ?>">
                </div>

                <!-- Usuario -->
                <div class="form-group col-md-4">
                  <label for="usuario">Usuario: </label>
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo $admin['usuario']; ?>">
                </div>

                <!-- Password -->
                <div class="form-group col-md-4">
                  <label for="password">Password: </label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password para iniciar sesion">
                </div>

                <!-- Nivel -->
                <div class="form-group col-md-4">
                  <label for="nivel">Nivel de usuario: </label>
                  <select name="nivel" id="nivel" class="form-control" value="<?php echo $admin['nivel']; ?>">
                    <option value=""> -- Seleccione -- </option>
                    <option <?php echo "0" == $admin['nivel'] ? "selected" : "" ?> value="0">Usuario estándar</option>
                    <option <?php echo "1" == $admin['nivel'] ? "selected" : "" ?> value="1">Administrador</option>
                  </select>
                  <span id="resultado_nivel_usuario" class="help-block"></span>
                </div>

              </div>

              <div class="box-footer">
                <input type="hidden" name="id" value="<?php echo openssl_encrypt($id, COD, KEY); ?>">
                <button type="submit" name="dashboard" value="administrador-editar1" class="btn btn-primary">Actualizar</button>
              </div>
            </form>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->