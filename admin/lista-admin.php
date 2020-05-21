<?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Administradores
        <small> Aquí podrás editar o eliminar a los Usuarios registrados. </small>
      </h1>
    </section>
    <section class="content"> <!-- Main content -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Administrar a los Usuarios</h3>
            </div>
            <div class="box-body"> <!-- /.box-header -->
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nº</th>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Nivel de Usuario</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    try {
                      $sql = "SELECT id_admin, usuario, nombre, nivel FROM admins"; //Crea consulta SQL
                      $resultado = $conn->query($sql); //Ejecuta consulta SQL
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }
                    $numero = 1;
                    while($admin = $resultado->fetch_assoc()) { 
                  ?>
                      <tr>
                        <td> <?php echo $numero; ?> </td>
                        <td><?php echo $admin['usuario']; ?></td>
                        <td><?php echo $admin['nombre']; ?></td>
                        <td><?php 
                              if($admin['nivel'] == 1) {
                                echo 'Administrador';
                              } else {
                                echo 'Usuario Estándar';
                              }
                            ?>
                        </td>
                        <td>
                          <a href="editar-admin.php?id=<?php echo $admin['id_admin']; ?>" class="btn bg-orange btn-flat margin">
                          <i class="fa fa-pencil-alt"></i>
                          </a>
                          <a href="#" data-id="<?php echo $admin['id_admin']; ?>" data-tipo="admin" class="btn bg-maroon btn-flat margin borrar_registro">
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
                  <th>Usuario</th>
                  <th>Nombres y Apellidos</th>
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
<?php
  include_once 'templates/footer.php';
?>