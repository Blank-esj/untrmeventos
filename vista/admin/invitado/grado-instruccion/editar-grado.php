<?php
$id = openssl_decrypt($_POST['id'], COD, KEY);
if (!filter_var($id, FILTER_VALIDATE_INT)) :
    die("Error");
else :
?>

    <?php
    $id = openssl_decrypt($_POST['id'], COD, KEY);
    if (!filter_var($id, FILTER_VALIDATE_INT)) :
        die("Error");
    else :
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Editar Grado Acad{emico} de Invitados
                    <small>Puede modificar los datos del Grado Académico aquí.</small>
                </h1>
            </section>
            <div class="row">
                <div class="col-md-12">
                    <section class="content">
                        <!-- Main content -->
                        <div class="box">
                            <!-- Default box -->

                            <div class="box-header with-border">
                                <h3 class="box-title">Crear Grado Académico</h3>
                            </div>
                            <form method="post" action="dashboard">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <?php
                                            $sql = "SELECT * FROM grado_instruccion WHERE idgrado_instruccion = $id ";
                                            $resultado = $conn->query($sql);
                                            $grado = $resultado->fetch_assoc();
                                            ?>
                                            <div class="form-group">

                                                <!-- Nombre -->
                                                <div class="form-group">
                                                    <label for="nombre">Grado Académico: </label>
                                                    <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del grado académico" value="<?php echo $grado['grado']; ?>">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <input type="hidden" name="id" value="<?Php echo openssl_encrypt($id, COD, KEY); ?>">
                                        <button type="submit" name="dashboard" value="grado-editar1" class="btn btn-primary">Actualizar</button>
                                    </div>

                            </form>
                        </div> <!-- /.box-body -->

                    </section> <!-- /.content -->
                </div> <!-- /.box -->
            </div>
        </div> <!-- /.content-wrapper -->
    <?php
    endif;
    ?>
<?php
endif;
?>