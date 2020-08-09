<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Registrados
      <small>Aquí podrás editar y eliminar a los Registrados. </small>
    </h1>
  </section>
  <section class="content">
    <!-- Main content -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Administra a los registrados</h3>
          </div>
          <div class="box-body">
            <!-- /.box-header -->
            <table id="registros" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nº</th>
                  <th>Boleto</th>
                  <th>Venta</th>
                  <th>Comprador</th>
                  <th>Asistente</th>
                  <th>Plan</th>
                  <th>Regalo</th>
                  <th>Email</th>
                  <th>Teléfono</th>
                  <th>N° Documento</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $sql = "SELECT * FROM v_boleto ";
                  $resultado = $conn->query($sql);
                } catch (Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }
                $numero = 1;
                if ($resultado != false) {

                  while ($registrado = $resultado->fetch_assoc()) {
                ?>
                    <tr>
                      <td> <?php echo $numero; ?> </td>
                      <td> <?php echo $registrado['boleto'] ?> </td>
                      <td> <?php echo $registrado['estado_venta'] ?> </td>
                      <td> <?php echo $registrado['comprador']; ?> </td>
                      <td> <?php echo $registrado['asistente']; ?> </td>
                      <td> <?php echo $registrado['plan']; ?> </td>
                      <td> <?php echo $registrado['regalo']; ?> </td>
                      <td> <?php echo $registrado['email']; ?> </td>
                      <td> <?php echo $registrado['telefono']; ?> </td>
                      <td> <?php echo $registrado['doc_identidad']; ?> </td>
                      <td>

                        <?php $id = openssl_encrypt($registrado['idboleto'], COD, KEY); ?>

                        <form action="dashboard" method="post" style="display: inline;">
                          <input type="hidden" name="id" value="<?php echo $id ?>">
                          <button type="submit" name="dashboard" value="boleto-editar0" class="btn btn-warning">
                            <i class="fa fa-pencil-alt"></i>
                          </button>
                        </form>

                        <form action="dashboard" method="post" style="display: inline;">
                          <input type="hidden" name="id" value="<?php echo $id ?>">
                          <button type="submit" name="dashboard" value="boleto-eliminar" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>

                      </td>
                    </tr>
                <?php
                    $numero++;
                  }
                } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Nº</th>
                  <th>Boleto</th>
                  <th>Venta</th>
                  <th>Comprador</th>
                  <th>Asistente</th>
                  <th>Plan</th>
                  <th>Regalo</th>
                  <th>Email</th>
                  <th>Teléfono</th>
                  <th>N° Documento</th>
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