<?php
include_once 'modelo/modelo-venta.php';

$ventaModelo = new VentaModelo();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de las Ventas
            <small>Aquí podrás visualizar las ventas realizadas. </small>
        </h1>
    </section>
    <section class="content">
        <!-- Main content -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Gestionar Ventas</h3>
                    </div>
                    <div class="box-body">
                        <!-- /.box-header -->
                        <table id="registros" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Estado</th>
                                    <th>Comprador</th>
                                    <th>Moneda</th>
                                    <th>Compra</th>
                                    <th>Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ventas = $ventaModelo->leerTodos();

                                include_once 'modelo/modelo-plan.php';

                                $planModelo = new PlanModelo();

                                foreach ($ventas as $indice => $arrayVenta) { ?>

                                    <tr>
                                        <td> <?php echo $indice + 1; ?> </td>
                                        <td> <?php echo $arrayVenta['estado'] ?> </td>
                                        <td>

                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modal-comprador-<?php echo $indice ?>">
                                                <?php echo $arrayVenta['nombres'] != null ? $arrayVenta['nombres'] . " " . $arrayVenta['apellidos'] : "*"; ?>
                                            </button>

                                        </td>
                                        <td> <?php echo $arrayVenta['moneda'] ?> </td>
                                        <td> <?php echo $arrayVenta['tarifa_transaccion'] ?> </td>
                                        <td style="text-align: right;">

                                            <button style="margin-bottom: 5px;" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseVentaTotal-<?php echo $indice ?>" aria-expanded="false" aria-controls="collapseVentaTotal-<?php echo $indice ?>">
                                                <?php echo "Total: $" . number_format($arrayVenta['total'], 2) . "<br/>" ?>
                                            </button>

                                            <div class="collapse" id="collapseVentaTotal-<?php echo $indice ?>">
                                                <div class="card card-body">

                                                    <button type="button" class="btn btn-link text-right" data-toggle="modal" data-target="#modal-articulos-<?php echo $indice ?>">
                                                        <?php echo "Articulos: $" . number_format($arrayVenta['st_articulos'], 2) . "<br/>" ?>
                                                    </button>
                                                    <br />
                                                    <button type="button" class="btn btn-link text-right" data-toggle="modal" data-target="#modal-planes-<?php echo $indice ?>">
                                                        <?php echo "Planes: $" . $arrayVenta['st_plan'] . "<br/>" ?>
                                                    </button>
                                                    <br />
                                                    <button type="button" class="btn btn-link text-right">
                                                        <?php echo "Total PayPal: $" . $arrayVenta['total_paypal'] ?>
                                                    </button>

                                                </div>
                                            </div>



                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-comprador-<?php echo $indice ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">
                                                        <?php echo $arrayVenta['nombres'] . " " ?>
                                                        <?php echo $arrayVenta['apellidos'] ?>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-dialog modal-dialog-scrollable">

                                                        <p> <strong>Correo Comprador: </strong> <?php echo $arrayVenta['correo_comprador'] . "<br/>" ?> </p>

                                                        <p> <strong>Correo Proporcionado: </strong> <?php echo $arrayVenta['correo_proporcionado'] ?> </p>

                                                        <p> <strong>Teléfono: </strong> <?php echo $arrayVenta['telefono'] ?> </p>

                                                        <p> <strong>Dirección: </strong> <?php echo $arrayVenta['direccion'] ?> </p>

                                                        <p> <strong>Ciudad: </strong> <?php echo $arrayVenta['ciudad'] ?> </p>

                                                        <p> <strong>Provincia: </strong> <?php echo $arrayVenta['provincia'] ?> </p>

                                                        <p> <strong>Código Postal: </strong> <?php echo $arrayVenta['cod_postal'] ?> </p>

                                                        <p> <strong>Pais: </strong> <?php echo $arrayVenta['pais'] ?> </p>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modal-articulos-<?php echo $indice ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">Articulos</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-dialog modal-dialog-scrollable container-fluid">
                                                        <div class="row">
                                                            <div class="col-sm-2"><strong>Imagen</strong></div>
                                                            <div class="col-sm-3"><strong>Nombre</strong></div>
                                                            <div class="col-sm-2 text-right"><strong>Precio</strong></div>
                                                            <div class="col-sm-2 text-right"><strong>Cantidad</strong></div>
                                                            <div class="col-sm-2 text-right"><strong>Subtotal</strong></div>
                                                        </div>
                                                        <?php
                                                        include_once 'modelo/modelo-venta_articulo.php';

                                                        $ventaArticuloModelo = new VentaArticuloModelo();
                                                        $articulos = $ventaArticuloModelo->leerPorVenta($arrayVenta['idventa']);

                                                        $subtotal = 0;
                                                        foreach ($articulos as $arrayArticulo) {
                                                            $sub = $arrayArticulo['precio'] * $arrayArticulo['cantidad'];
                                                            $subtotal += $sub; ?>
                                                            <div class="row">
                                                                <div class="col-sm-2"><img src="<?php echo DIR_IMG_ARTICULO . $arrayArticulo['url_imagen'] ?>" alt="imagen" height="50px"></div>
                                                                <div class="col-sm-3"><span><?php echo $arrayArticulo['articulo'] ?></span></div>
                                                                <div class="col-sm-2 text-right"><span>$ <?php echo $arrayArticulo['precio'] ?></span></div>
                                                                <div class="col-sm-2 text-right"><span><?php echo $arrayArticulo['cantidad'] ?></span></div>
                                                                <div class="col-sm-2 text-right"><span>$ <?php echo number_format($sub, 2) ?></span></div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="row">
                                                            <div class="col-sm-9 text-right"><strong>Subtotal</strong></div>
                                                            <div class="col-sm-2 text-right"><span>$ <?php echo number_format($subtotal, 2) ?></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modal-planes-<?php echo $indice ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">Planes</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-sm-5"><strong>Nombre</strong></div>
                                                                <div class="col-sm-2 text-right"><strong>Precio</strong></div>
                                                                <div class="col-sm-2 text-right"><strong>Cantidad</strong></div>
                                                                <div class="col-sm-2 text-right"><strong>Subtotal</strong></div>
                                                            </div>
                                                            <?php
                                                            include_once 'modelo/modelo-plan.php';

                                                            $planoModelo = new PlanModelo();
                                                            $planes = $planoModelo->leerPorVenta($arrayVenta['idventa']);
                                                            $subtotal = 0;
                                                            foreach ($planes as $arrayPlan) {
                                                                $sub = $arrayPlan['precio'] * $arrayPlan['cantidad'];
                                                                $subtotal += $sub; ?>
                                                                <div class="row">
                                                                    <div class="col-sm-5"><?php echo $arrayPlan['nombre'] ?></div>
                                                                    <div class="col-sm-2 text-right"><span>$ <?php echo $arrayPlan['precio'] ?></span></div>
                                                                    <div class="col-sm-2 text-right"><span><?php echo $arrayPlan['cantidad'] ?></span></div>
                                                                    <div class="col-sm-2 text-right"><span>$ <?php echo number_format($sub, 2) ?></span></div>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="row">
                                                                <div class="col-sm-9 text-right"><strong>Subtotal</strong></div>
                                                                <div class="col-sm-2 text-right"><span>$ <?php echo number_format($subtotal, 2) ?></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nº</th>
                                    <th>Estado</th>
                                    <th>Comprador</th>
                                    <th>Moneda</th>
                                    <th>Compra</th>
                                    <th>Detalle</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->