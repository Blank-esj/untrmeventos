<?php
error_reporting(0);
include_once '../../plantillas/cabecera-admin.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Categorias de Eventos
      <small>Aquí podrás editar y eliminar las Categorías de los Eventos registrados. </small>
    </h1>
  </section>
  <section class="content">
    <!-- Main content -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Administra las categorías</h3>
          </div>
          <div class="box-body">
            <!-- /.box-header -->
            <table id="registros" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nº</th>
                  <th>Nombre de Categoria</th>
                  <th>Icono</th>
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
                      <a href="editar-categoria.php?id=<?php echo $categoria['id_categoria'] ?>" class="btn bg-orange btn-flat margin">
                        <i class="fa fa-pencil-alt"></i>
                      </a>
                      <a href="#" data-id="<?php echo $categoria['id_categoria']; ?>" data-tipo="categoria" class="btn bg-maroon btn-flat margin borrar_registro">
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
                  <th>Nombre de Categoria</th>
                  <th>Icono</th>
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