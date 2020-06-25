<?php
error_reporting(0);
include_once '../../plantillas/cabecera-admin.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Invitados
      <small>Aquí podrás editar y eliminar a los Invitados registrados. </small>
    </h1>
  </section>
  <section class="content">
    <!-- Main content -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Administra a los invitados</h3>
          </div>
          <div class="box-body">
            <!-- /.box-header -->
            <table id="registros" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nº</th>
                  <th>Nombre de Invitado</th>
                  <th>Biografia</th>
                  <th>Imagen</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $sql = "SELECT * FROM invitado ";
                  $resultado = $conn->query($sql);
                } catch (Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }

                $numero = 1;
                while ($invitado = $resultado->fetch_assoc()) {
                ?>
                  <tr>
                    <td> <?php echo $numero; ?> </td>
                    <td><?php echo $invitado['nombre_invitado'] . " " . $invitado['apellidopa_invitado'] . " " . $invitado['apellidoma_invitado']; ?></td>
                    <td><?php echo $invitado['descripcion']; ?></td>
                    <td><img src="../../assets/img/invitados/<?php echo $invitado['url_imagen']; ?>" width="150"></td>
                    <td>
                      <a href="editar-invitado.php?id=<?php echo $invitado['id_invitado'] ?>" class="btn bg-orange btn-flat margin">
                        <i class="fa fa-pencil-alt"></i>
                      </a>
                      <a href="#" data-id="<?php echo $invitado['id_invitado']; ?>" data-tipo="invitado" class="btn bg-maroon btn-flat margin borrar_registro">
                        <i class="fa fa-trash"></i>
                      </a>
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
                  <th>Nombre de Invitado</th>
                  <th>Biografia</th>
                  <th>Imagen</th>
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
<?php
include_once '../../plantillas/footer-admin.php';
?>