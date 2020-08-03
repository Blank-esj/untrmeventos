<?php
$id = openssl_decrypt($_POST['id'], COD, KEY);
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
        <div class="col-md-12">
            <section class="content">
                <!-- Main content -->
                <div class="box">
                    <!-- Default box -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Artículo</h3>
                    </div>
                    <div class="box-body">
                        <!-- form start -->
                        <form method="post" action="dashboard" enctype="multipart/form-data">
                            <div class="box-body">

                                <?php
                                $sql = "SELECT * FROM articulo WHERE idarticulo = $id ";
                                $resultado = $conn->query($sql);
                                $articulo = $resultado->fetch_assoc();
                                ?>

                                <div class="row">

                                    <!-- Nombre -->
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Nombre </label>
                                        <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" value="<?php echo $articulo['nombre_articulo']; ?>">
                                    </div>

                                    <!-- url_imagen -->
                                    <div class="form-group col-md-3">
                                        <label for="imagen_actual">Imagen Actual:</label>
                                        <br>
                                        <img src="<?php echo DIR_IMG_ARTICULO . $articulo['url_imagen']; ?>" width="100">
                                    </div>

                                    <!-- url_imagen / imagen_articulo -->
                                    <div class="form-group col-md-3">
                                        <label for="imagen_articulo">Imagen:</label>
                                        <input type="file" id="imagen_articulo" name="archivo_imagen">
                                        <p class="help-block">Agregar la imagen del articulo aquí.</p>
                                    </div>

                                    <!-- Precio -->
                                    <div class="form-group col-md-6">
                                        <label for="precio">Precio </label>
                                        <input required type="number" class="form-control" name="precio" id="precio" placeholder="Ingrese el precio" value="<?php echo $articulo['precio']; ?>">
                                    </div>

                                    <!-- Stock -->
                                    <div class="form-group col-md-6">
                                        <label for="stock">Stock </label>
                                        <input required type="number" class="form-control" name="stock" id="stock" placeholder="Ingrese el stock" value="<?php echo $articulo['stock']; ?>">
                                    </div>

                                    <!-- Descripción -->
                                    <div class="mb-3 col-md-12">
                                        <label for="btextarea">Descripcion</label>
                                        <textarea class="form-control" id="btextarea" name="descripcion" placeholder="Ingrese una descripcion"><?php echo $articulo['descripcion']; ?></textarea>
                                    </div>

                                </div>

                            </div> <!-- /.box-body -->

                            <div class="box-footer">

                                <input type="hidden" name="id" value="<?Php echo openssl_encrypt($id, COD, KEY); ?>">
                                <button type="submit" name="dashboard" value="articulo-editar1" class="btn btn-primary">Actualizar</button>

                            </div>
                        </form>
                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </section> <!-- /.content -->
        </div>
    </div>
</div> <!-- /.content-wrapper -->