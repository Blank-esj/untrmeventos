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
                  <th>Compra</th>
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
                      <td> <?php echo $registrado['estado_venta'] ?> </td>
                      <td> <?php echo $registrado['comprador']; ?> </td>
                      <td> <?php echo $registrado['asistente']; ?> </td>
                      <td> <?php echo $registrado['plan']; ?> </td>
                      <td> <?php echo $registrado['regalo']; ?> </td>
                      <td> <?php echo $registrado['email']; ?> </td>
                      <td> <?php echo $registrado['telefono']; ?> </td>
                      <td> <?php echo $registrado['doc_identidad']; ?> </td>
                      <td>
                        <a href="editar-registrado.php?id=<?php echo $registrado['id_registrado'] ?>" class="btn bg-orange btn-flat margin">
                          <i class="fa fa-pencil-alt"></i>
                        </a>
                        <a href="#" data-id="<?php echo $registrado['id_registrado']; ?>" data-tipo="registrado" class="btn bg-maroon btn-flat margin borrar_registro">
                          <i class="fa fa-trash"></i>
                        </a>
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
                  <th>Compra</th>
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