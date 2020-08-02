<?php
//Captura de datos para proceder con la consulta SQL y llenar el formulario.
$id = openssl_decrypt($_POST['id'], COD, KEY);
if (!filter_var($id, FILTER_VALIDATE_INT)) { //Valida que el id sea entero. Negamos para valida si alguien envia letras
    die("Error!");
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Regalo
            <small>Llena el formulario para editar un Regalo.</small>
        </h1>
    </section>
    <div class="row">
        <div class="col-md-12">
            <section class="content">
                <!-- Main content -->
                <div class="box">
                    <!-- Default box -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Regalo</h3>
                    </div>
                    <form method="post" action="dashboard">
                        <div class="box-body">
                            <div class="row">

                                <?php
                                include_once 'modelo/modelo-regalo.php';
                                $regalo = (new RegaloModelo())->leerRegalo($id)[0];
                                ?>

                                <!-- Nombre -->
                                <div class="form-group col-md-6">
                                    <label for="nombre">Nombre </label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" value="<?Php echo $regalo['nombre_regalo']; ?>">
                                </div>

                                <!-- Stock -->
                                <div class="form-group col-md-6">
                                    <label for="stock">Stock </label>
                                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Ingrese el stock" value="<?Php echo $regalo['stock']; ?>">
                                </div>

                            </div>

                        </div> <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?Php echo openssl_encrypt($id, COD, KEY); ?>">
                            <button type="submit" name="dashboard" value="regalo-editar1" class="btn btn-primary">Actualizar</button>
                        </div>

                    </form>
                </div> <!-- /.box-body -->
        </div> <!-- /.box -->
        </section> <!-- /.content -->
    </div>
</div> <!-- /.content-wrapper -->