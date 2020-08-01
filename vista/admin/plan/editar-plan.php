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
                Crear Plan
                <small>Llena el formulario para crear un Plan.</small>
            </h1>
        </section>
        <div class="row">
            <div class="col-md-12">
                <section class="content">
                    <!-- Main content -->
                    <div class="box">
                        <!-- Default box -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Crear Plan</h3>
                        </div>

                        <?php
                        include_once 'modelo/modelo-plan.php';
                        $modeloPlan = (new PlanModelo())->leer($id)[0];
                        ?>

                        <form method="post" action="dashboard">
                            <div class="box-body">

                                <!-- Nombre -->
                                <div class="form-group">
                                    <label for="nombre">Nombre </label>
                                    <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" value="<?php echo $modeloPlan['nombre']; ?>">
                                </div>

                                <!-- Precio -->
                                <div class="form-group">
                                    <label for="precio">Precio </label>
                                    <input required type="number" class="form-control" name="precio" id="precio" placeholder="Ingrese el precio" value="<?php echo $modeloPlan['precio']; ?>">
                                </div>

                                <!-- Descripción -->
                                <div class="mb-3">
                                    <label for="btextarea">Descripcion</label>
                                    <textarea class="form-control" id="btextarea" name="descripcion" placeholder="Ingrese una descripcion"><?php echo $modeloPlan['descripcion']; ?></textarea>
                                </div>

                                <!-- Beneficio -->
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Beneficio</h6>
                                        <?php
                                        include 'modelo/modelo-beneficio.php';
                                        include 'modelo/modelo-plan-beneficio.php';

                                        $idsBeneficio = array_column((new PlanBeneficioModelo())->beneficioPlan($id), "idbeneficio");

                                        foreach ((new BeneficioModelo())->leerTodos($connPDO) as $indice => $arrayBeneficio) { ?>

                                            <div class="form-check">
                                                <input <?php echo in_array($arrayBeneficio['idbeneficio'], $idsBeneficio) ? "checked" : "" ?> class="form-check-input" type="checkbox" name="check-beneficio[]" value="<?php echo openssl_encrypt($arrayBeneficio['idbeneficio'], COD, KEY) ?>" id="check-<?php echo $indice ?>">
                                                <label class="form-check-label" for="check-<?php echo $indice ?>">
                                                    <?php echo $arrayBeneficio['nombre'] ?>
                                                </label>
                                            </div>

                                        <?php } ?>
                                    </div>
                                </div>

                            </div> <!-- /.box-body -->

                            <div class="box-footer">
                                <input type="hidden" name="id" value="<?Php echo openssl_encrypt($id, COD, KEY); ?>">
                                <button type="submit" name="dashboard" value="plan-editar1" class="btn btn-primary">Actualizar</button>
                            </div>

                        </form>
                    </div> <!-- /.box-body -->
            </div> <!-- /.box -->
            </section> <!-- /.content -->
        </div>
    </div> <!-- /.content-wrapper -->
<?php
endif;
?>