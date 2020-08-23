<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Temas
      <small> Aquí podrás editar y eliminar los temas registrados. </small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Gestionar Temas</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="registros" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nº</th>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoría</th>
                  <th>Invitado</th>
                  <th>Clave</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $sql = "SELECT * FROM v_evento;";
                  $resultado = $conn->query($sql); //Ejecuta consulta SQL
                } catch (Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }
                $numero = 1;
                while ($evento = $resultado->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $numero; ?> </td>
                    <td><?php echo $evento['evento']; ?></td>
                    <td><?php echo $evento['fecha']; ?></td>
                    <td><?php echo $evento['hora']; ?> </td>
                    <td><?php echo $evento['categoria']; ?> </td>
                    <td><?php echo $evento['invitado']; ?> </td>
                    <td><?php echo $evento['clave']; ?> </td>
                    <td>

                      <?php $id = openssl_encrypt($evento['id_evento'], COD, KEY); ?>

                      <form action="dashboard" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <button type="submit" name="dashboard" value="evento-editar0" class="btn btn-warning">
                          <i class="fa fa-pencil-alt"></i>
                        </button>
                      </form>

                      <form action="dashboard" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <button type="submit" name="dashboard" value="evento-eliminar" class="btn btn-danger">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>

                    </td>
                  </tr>
                <?php
                  $numero++;
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Nº</th>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoría</th>
                  <th>Invitado</th>
                  <th>Clave</th>
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