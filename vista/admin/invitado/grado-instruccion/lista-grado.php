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
                                    include_once 'modelo/modelo-grado_instruccion.php';
                                    foreach ((new GradoInstruccionModelo())->leerTodos() as $indice => $arrayInvitado) { ?>

                                        <tr>
                                            <td><?php echo $indice + 1; ?> </td>
                                            <td><?php echo $arrayInvitado['grado']; ?></td>
                                            <td>

                                                <?php $id = openssl_encrypt($arrayInvitado['idgrado_instruccion'], COD, KEY); ?>

                                                <form action="dashboard" method="post" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                                    <button type="submit" name="dashboard" value="grado-editar0" class="btn btn-warning">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>
                                                </form>

                                                <form action="dashboard" method="post" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                                    <button type="submit" name="dashboard" value="grado-eliminar" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

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