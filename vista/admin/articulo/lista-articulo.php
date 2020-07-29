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
                                while ($articulo = $resultado->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td> <?php echo $numero; ?> </td>
                                        <td><?php echo $articulo['nombre_articulo'] ?></td>
                                        <td><?php echo $articulo['precio'] ?></td>
                                        <td><?php echo $articulo['stock']; ?></td>
                                        <td><?php echo $articulo['descripcion']; ?></td>
                                        <td><img src="../../assets/img/invitados/<?php echo $articulo['url_imagen']; ?>" width="150"></td>
                                        <td>
                                            <a href="editar-articulo.php?id=<?php echo $articulo['idarticulo'] ?>" data-id="<?php echo $articulo['idarticulo']; ?>" class="btn bg-orange btn-flat margin">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <a href="#" data-id="<?php echo $articulo['idarticulo']; ?>" data-tipo="articulo" class="btn bg-maroon btn-flat margin borrar_registro">
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