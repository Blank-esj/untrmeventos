<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Eventos
      <small> Aquí podrás editar y eliminar los Eventos registrados. </small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Administra los eventos</h3>
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
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $sql = "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, CONCAT(nombres, ' ', apellidopa, ' ', apellidoma) AS nombre_completo_invitado FROM evento "; //Crea consulta SQL.
                  $sql .= " INNER JOIN categoria_evento ON evento.id_cat_evento = categoria_evento.id_categoria ";
                  $sql .= " INNER JOIN persona ON evento.id_inv = persona.idpersona ";
                  $sql .= " ORDER BY id_evento ";
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
                    <td><?php echo $evento['nombre_evento']; ?></td>
                    <td><?php echo $evento['fecha_evento']; ?></td>
                    <td><?php echo $evento['hora_evento']; ?> </td>
                    <td><?php echo $evento['cat_evento']; ?> </td>
                    <td><?php echo $evento['nombre_completo_invitado']; ?> </td>
                    <td>
                      <a href="editar-evento.php?id=<?php echo $evento['id_evento']; ?>" class="btn bg-orange btn-flat margin">
                        <i class="fa fa-pencil-alt"></i>
                      </a>
                      <a href="#" data-id="<?php echo $evento['id_evento']; ?>" data-tipo="evento" class="btn bg-maroon btn-flat margin borrar_registro">
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
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoría</th>
                  <th>Invitado</th>
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