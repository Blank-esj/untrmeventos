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
        <div class="col-md-8">
            <section class="content">
                <!-- Main content -->
                <div class="box">
                    <!-- Default box -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Plan</h3>
                    </div>
                    <form method="post" action="">
                        <div class="box-body">

                            <!-- Nombre -->
                            <div class="form-group">
                                <label for="nombre">Nombre </label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre">
                            </div>

                            <!-- Precio -->
                            <div class="form-group">
                                <label for="precio">Precio </label>
                                <input type="number" class="form-control" name="precio" id="precio" placeholder="Ingrese el precio">
                            </div>

                            <!-- Descripción -->
                            <div class="mb-3">
                                <label for="btextarea">Descripcion</label>
                                <textarea class="form-control" id="btextarea" name="descripcion" placeholder="Ingrese una descripcion"></textarea>
                            </div>

                            <!-- Beneficio -->
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Beneficio</h6>
                                    <?php
                                    include 'modelo/beneficio.php';
                                    foreach ((new Beneficio())->leerTodos($connPDO) as $indice => $arrayBeneficio) { ?>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="check-beneficio" value="<?php echo openssl_encrypt($arrayBeneficio['idbeneficio'], COD, KEY) ?>" id="check-<?php echo $indice ?>">
                                            <label class="form-check-label" for="check-<?php echo $indice ?>">
                                                <?php echo $arrayBeneficio['nombre'] ?>
                                            </label>
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>

                        </div> <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="dashboard" value="plan-crear">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>

                    </form>
                </div> <!-- /.box-body -->
        </div> <!-- /.box -->
        </section> <!-- /.content -->
    </div>
</div> <!-- /.content-wrapper -->