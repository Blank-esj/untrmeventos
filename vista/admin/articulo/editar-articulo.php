<?php
$id = $_GET['id'];
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("Error el id: {$id} no es un entero.");
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Artículos
            <small>Puedes modificar los datos de los Artículos aquí.</small>
        </h1>
    </section>
    <div class="row">
        <div class="col-md-8">
            <section class="content">
                <!-- Main content -->
                <div class="box">
                    <!-- Default box -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Artículo</h3>
                    </div>
                    <div class="box-body">
                        <?php
                        $sql = "SELECT * FROM articulo WHERE idarticulo = $id ";
                        $resultado = $conn->query($sql);
                        $articulo = $resultado->fetch_assoc();
                        ?>
                        <!-- form start -->
                        <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo/modelo-articulo.php" enctype="multipart/form-data">
                            <div class="box-body">

                                <!-- Nombre -->
                                <div class="form-group">
                                    <label for="nombre_articulo">Nombres: </label>
                                    <input type="text" class="form-control" id="nombre_articulo" name="nombre_articulo" placeholder="Ingresa nombre de articulo" value="<?php echo $articulo['nombre_articulo']; ?>">
                                </div>

                                <!-- Precio -->
                                <div class="form-group">
                                    <label for="precio">Precio: </label>
                                    <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingresa un precio" value="<?php echo $articulo['precio']; ?>">
                                </div>

                                <!-- Stock -->
                                <div class="form-group">
                                    <label for="stock">Stock: </label>
                                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Ingrese el stock" value="<?php echo $articulo['stock']; ?>">
                                </div>

                                <!-- Descripción -->
                                <div class="form-group">
                                    <label for="descripcion">Descripción: </label>
                                    <textarea class="form-control" name="descripcion" id="descripcion" rows="8" placeholder="Presentación del articulo"><?php echo $articulo['descripcion']; ?></textarea>
                                </div>

                                <!-- url_imagen -->
                                <div class="form-group">
                                    <label for="imagen_actual">Imagen Actual:</label>
                                    <br>
                                    <img src="../img/invitados/<?php echo $articulo['url_imagen']; ?>" width="200">
                                </div>

                                <!-- Nueva url_imagen -->
                                <div class="form-group">
                                    <label for="imagen_articulo">Imagen:</label>
                                    <input type="file" id="imagen_articulo" name="archivo_imagen">
                                    <p class="help-block">Agregue la nueva imagen del articulo aquí.</p>
                                </div>

                            </div> <!-- /.box-body -->

                            <div class="box-footer">
                                <input type="hidden" name="registro" value="actualizar">
                                <input type="hidden" name="id_registro" value="<?php echo $invitado['idpersona']; ?>">
                                <button type="submit" class="btn btn-primary" id="crear_registro">Agregar</button>
                            </div>
                        </form>
                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </section> <!-- /.content -->
        </div>
    </div>
</div> <!-- /.content-wrapper -->