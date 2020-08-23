<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Crear Planes
            <small>Aquí podrás agregar un nuevo plan.</small>
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
                    <form method="post" action="dashboard">
                        <div class="box-body">

                            <!-- Nombre -->
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre: </label>
                                <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre">
                            </div>

                            <!-- Precio -->
                            <div class="form-group col-md-6">
                                <label for="precio">Precio: </label>
                                <input required type="number" class="form-control" name="precio" id="precio" placeholder="Ingrese el precio">
                            </div>

                            <!-- Descripción -->
                            <div class="form-group col-md-12"">
                                <label for=" btextarea">Descripcion: </label>
                                <textarea class="form-control" id="btextarea" name="descripcion" placeholder="Ingrese una descripción"></textarea>
                            </div>

                            <!-- Beneficio -->
                            <div class="form-group col-md-12">
                                <div class="card">
                                    <div class="card-body class=" form-group">
                                        <label class="card-subtitle mb-2 text-muted">Beneficios: </label>
                                        <?php
                                        include 'modelo/modelo-beneficio.php';
                                        foreach ((new BeneficioModelo())->leerTodos($connPDO) as $indice => $arrayBeneficio) { ?>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="check-beneficio[]" value="<?php echo openssl_encrypt($arrayBeneficio['idbeneficio'], COD, KEY) ?>" id="check-<?php echo $indice ?>">
                                                <label class="form-check-label" for="check-<?php echo $indice ?>">
                                                    <?php echo $arrayBeneficio['nombre'] ?>
                                                </label>
                                            </div>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="dashboard" value="plan-crear">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>

                    </form>
                </div> <!-- /.box -->
            </section> <!-- /.content -->
        </div> <!-- /.box -->
    </div>
</div> <!-- /.content-wrapper -->