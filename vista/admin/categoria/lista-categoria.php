<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Categorías
      <small>Aquí podrás editar y eliminar las categorías registradas. </small>
    </h1>
  </section>
  <section class="content">
    <!-- Main content -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Gestionar Categorías</h3>
          </div>
          <div class="box-body">
            <!-- /.box-header -->
            <table id="registros" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nº</th>
                  <th>Nombre</th>
                  <th>Ícono</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $sql = "SELECT * FROM categoria_evento ";
                  $resultado = $conn->query($sql);
                } catch (Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }
                $numero = 1;
                while ($categoria = $resultado->fetch_assoc()) {
                ?>
                  <tr>
                    <td> <?php echo $numero; ?> </td>
                    <td><?php echo $categoria['cat_evento']; ?></td>
                    <td><i class="fa <?php echo $categoria['icono']; ?>"></i></td>

                    <td>

                      <?php $idcat = openssl_encrypt($categoria['id_categoria'], COD, KEY); ?>

                      <form action="dashboard" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $idcat ?>">
                        <button type="submit" name="dashboard" value="categoria-evento-editar0" class="btn btn-warning">
                          <i class="fa fa-pencil-alt"></i>
                        </button>
                      </form>

                      <form action="dashboard" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $idcat ?>">
                        <button type="submit" name="dashboard" value="categoria-evento-eliminar" class="btn btn-danger">
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
                  <th>Ícono</th>
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