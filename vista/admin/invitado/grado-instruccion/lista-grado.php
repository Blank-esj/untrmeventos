<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Grados Académicos
            <small> Aquí podrás editar y eliminar los Grados Académicos registrados. </small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Administra los grados académicos</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="registros" class="table table-bordered table-striped table-hover container-fluid" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'modelo/plan.php';
                                    foreach ((new Plan())->leerPlanes($connPDO) as $indice => $arrayPlan) { ?>

                                        <tr>
                                            <td><?php echo $indice + 1; ?> </td>
                                            <td><?php echo $arrayPlan['nombre']; ?></td>
                                            <td>
                                                <a href=" dashboard?plan-editar=<?php echo openssl_encrypt($arrayPlan['idplan'], COD, KEY) ?>" class="btn bg-orange btn-flat margin">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <a href="dashboard?plan-eliminar=<?php echo $arrayPlan['idplan']; ?>" class="btn bg-maroon btn-flat margin borrar_registro">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div> <!-- /.box-body -->
                    </div> <!-- /.box -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->