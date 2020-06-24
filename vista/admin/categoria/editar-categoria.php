<?php
  //Captura de datos para proceder con la consulta SQL y llenar el formulario.
  $id = $_GET['id'];
  if(!filter_var($id, FILTER_VALIDATE_INT)) { //Valida que el id sea entero. Negamos para valida si alguien envia letras
    die("Error!");
  }
  include_once '../../plantillas/cabecera-admin.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Categorías de Eventos
        <small>Puedes modificar los datos de Categoría aquí.</small>
      </h1>
    </section>
    <div class="row">
      <div class="col-md-8"> 
        <section class="content"> <!-- Main content -->
          <div class="box"> <!-- Default box -->
            <div class="box-header with-border">
              <h3 class="box-title">Editar Categoría</h3>
            </div>
            <div class="box-body">
            <?php 
                $sql = "SELECT * FROM categoria_evento WHERE id_categoria = $id ";
                $resultado = $conn->query($sql);
                $categoria = $resultado->fetch_assoc();
            ?>
            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="../../../modelo/modelo-categoria.php">
                <div class="box-body">
                  <div class="form-group">
                    <label for="usuario">Nombre: </label>
                    <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Ingresa nombre de categoría" value="<?Php echo $categoria['cat_evento']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="">Ícono: </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-address-book"> </i>
                        </div>
                        <input type="text" class="form-control pull-right" id="icono" name="icono" placeholder="fa-icon" value="<?Php echo $categoria['icono']; ?>">
                    </div>
                  </div>
                </div> <!-- /.box-body -->
                <div class="box-footer">
                  <input type="hidden" name="registro" value="actualizar">
                  <input type="hidden" name="id_registro" value="<?Php echo $id; ?>">
                  <button type="submit" class="btn btn-primary" id="crear_registro">Guardar</button>
                </div>
              </form>
            </div> <!-- /.box-body -->
          </div> <!-- /.box -->
        </section> <!-- /.content -->
      </div>
    </div>
  </div> <!-- /.content-wrapper -->
<?php
  include_once '../../plantillas/footer-admin.php';
?>