<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Artículos
            <small>Aquí podrás editar y eliminar a los Artículos registrados. </small>
        </h1>
    </section>
    <section class="content">
        <!-- Main content -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Administra a los artículos</h3>
                    </div>
                    <div class="box-body">
                        <!-- /.box-header -->
                        <table id="registros" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Descripción</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    $sql = "SELECT * FROM articulo";
                                    $resultado = $conn->query($sql);
                                } catch (Exception $e) {
                                    $error = $e->getMessage();
                                    echo $error;
                                }

                                $numero = 1;
                                include_once 'controlador/global/config.php';
                                while ($articulo = $resultado->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td> <?php echo $numero; ?> </td>
                                        <td><?php echo $articulo['nombre_articulo'] ?></td>
                                        <td><?php echo $articulo['precio'] ?></td>
                                        <td><?php echo $articulo['stock']; ?></td>
                                        <td><?php echo $articulo['descripcion']; ?></td>
                                        <td><img src="<?php echo DIR_IMG_ARTICULO . $articulo['url_imagen']; ?>" width="150"></td>
                                        <td>

                                            <?php $id = openssl_encrypt($articulo['idarticulo'], COD, KEY); ?>

                                            <form action="dashboard" method="post" style="display: inline;">
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <button type="submit" name="dashboard" value="articulo-editar0" class="btn btn-warning">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </button>
                                            </form>

                                            <form action="dashboard" method="post" style="display: inline;">
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <button type="submit" name="dashboard" value="articulo-eliminar" class="btn btn-danger">
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
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Descripción</th>
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