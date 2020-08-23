<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Administradores
      <small> Aquí podrás editar o eliminar los administradores registrados. </small>
    </h1>
  </section>
  <section class="content">
    <!-- Main content -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Gestionar Administradores</h3>
          </div>
          <div class="box-body">
            <!-- /.box-header -->
            <table id="registros" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nº</th>
                  <th>Nombres y Apellidos </th>
                  <th>Email</th>
                  <th>Teléfono</th>
                  <th>Documento de Identidad</th>
                  <th>Usuario</th>
                  <th>Nivel de Usuario</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $sql = "SELECT idpersona, nombre_completo, email, telefono, doc_identidad, usuario, nivel FROM v_admins"; //Crea consulta SQL
                  $resultado = $conn->query($sql); //Ejecuta consulta SQL
                } catch (Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }
                $numero = 1;
                if ($resultado != false) {
                  while ($admin = $resultado->fetch_assoc()) {
                ?>
                    <tr>
                      <td> <?php echo $numero; ?> </td>
                      <td><?php echo $admin['nombre_completo']; ?></td>
                      <td><?php echo $admin['email']; ?></td>
                      <td><?php echo $admin['telefono']; ?></td>
                      <td><?php echo $admin['doc_identidad']; ?></td>
                      <td><?php echo $admin['usuario']; ?></td>
                      <td><?php
                          if ($admin['nivel'] == 1) {
                            echo 'Administrador';
                          } else {
                            echo 'Usuario Estándar';
                          }
                          ?>
                      </td>
                      <td>
                        <?php $id = openssl_encrypt($admin['idpersona'], COD, KEY); ?>

                        <form action="dashboard" method="post" style="display: inline;">
                          <input type="hidden" name="id" value="<?php echo $id ?>">
                          <button type="submit" name="dashboard" value="administrador-editar0" class="btn btn-warning margin">
                            <i class="fa fa-pencil-alt"></i>
                          </button>
                        </form>

                        <form action="dashboard" method="post" style="display: inline;">
                          <input type="hidden" name="id" value="<?php echo $id ?>">
                          <button type="submit" name="dashboard" value="administrador-eliminar" class="btn btn-danger margin">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  <?php
                    $numero++;
                  }
                } else { ?>
                  <h1>No hay administradores</h1>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Nº</th>
                  <th>Nombres y Apellidos</th>
                  <th>Email</th>
                  <th>Teléfono</th>
                  <th>Documento de Identidad</th>
                  <th>Usuario</th>
                  <th>Nivel de Usuario</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
            </table>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </div> <!-- /.col -->
    </div> <!-- /.row -->
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->