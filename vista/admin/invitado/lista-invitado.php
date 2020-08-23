<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Invitados
      <small>Aquí podrás editar y eliminar los invitados registrados. </small>
    </h1>
  </section>
  <section class="content">
    <!-- Main content -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Gestionar Invitados</h3>
          </div>
          <div class="box-body">
            <!-- /.box-header -->
            <div class="table-responsive">
              <table id="registros" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Nº</th>
                    <th>Imagen</th>
                    <th>Nombres y Apellidos</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Documento de Identidad</th>
                    <th>Insticución de Procedencia</th>
                    <th>Grado Académico</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Sexo</th>
                    <th>Biografía</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $sql = "SELECT * FROM v_invitado";
                    $resultado = $conn->query($sql);
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }
                  $numero = 1;
                  if ($resultado != false) {
                    while ($invitado = $resultado->fetch_assoc()) {
                  ?>
                      <tr>
                        <td style="vertical-align: middle;"> <?php echo $numero; ?> </td>
                        <td style="vertical-align: middle;"><img style="border-radius: 50%;" src="<?php echo DIR_IMG_INVITADO . $invitado['url_imagen']; ?>" width="70" height="70"></td>
                        <td style="vertical-align: middle;"><?php echo $invitado['nombre_completo'] ?></td>
                        <td style="vertical-align: middle;"><?php echo $invitado['email'] ?></td>
                        <td style="vertical-align: middle;"><?php echo $invitado['telefono'] ?></td>
                        <td style="vertical-align: middle;"><?php echo $invitado['doc_identidad'] ?></td>
                        <td style="vertical-align: middle;"><?php echo $invitado['institucion_procedencia'] ?></td>
                        <td style="vertical-align: middle;"><?php echo $invitado['grado'] ?></td>
                        <td style="vertical-align: middle;"><?php echo $invitado['nacimiento'] ?></td>
                        <td style="vertical-align: middle;"><?php echo $invitado['sexo'] ?></td>
                        <td style="vertical-align: middle;"><?php echo $invitado['descripcion']; ?></td>
                        <td style="vertical-align: middle;">

                          <?php $id = openssl_encrypt($invitado['idpersona'], COD, KEY); ?>

                          <form action="dashboard" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <button type="submit" name="dashboard" value="invitado-editar0" class="btn btn-warning margin">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                          </form>

                          <form action="dashboard" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <button type="submit" name="dashboard" value="invitado-eliminar" class="btn btn-danger margin">
                              <i class="fa fa-trash"></i>
                            </button>
                          </form>

                        </td>
                      </tr>
                    <?php
                      $numero++;
                    }
                  } else { ?>
                    <h1>No hay iinvitados</h1>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Nº</th>
                    <th>Imagen</th>
                    <th>Nombres y Apellidos</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Documento de Identidad</th>
                    <th>Insticución de Procedencia</th>
                    <th>Grado Académico</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Sexo</th>
                    <th>Biografía</th>
                    <th>Acciones</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </div> <!-- /.col -->
    </div> <!-- /.row -->
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->