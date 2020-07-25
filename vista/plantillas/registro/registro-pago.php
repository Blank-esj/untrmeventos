<h3 class="box-title text-center">Finaliza tu inscripción</h3>
<div class="total col-md-12 align-items-center">
    <div class="card border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th class="text-center" scope="col">Cantidad</th>
                            <th class="text-center" scope="col">Precio</th>
                            <th class="text-center" scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($sesion->subtotal() as $indice => $subtotales) {
                            $total += $subtotales['subtotal'];
                        ?>

                            <tr>
                                <td>
                                    <?php echo $subtotales['nombre'] ?>

                                    <?php $soyArticulo = ($subtotales['tipo'] == N_ARTICULOS) ? true : false ?>

                                    <span style="cursor: pointer;" class="rounded-circle badge badge-<?php echo $soyArticulo ? "success" : "primary" ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $subtotales['tipo'] ?>">
                                        <i class="material-icons">
                                            <?php echo $soyArticulo ? "shopping_bag" : "psychology" ?>
                                        </i>
                                    </span>

                                </td>
                                <td class="text-center"> <?php echo $subtotales['cantidad'] ?> </td>
                                <td class="text-right"> $ <?php echo number_format($subtotales['precio'], 2) ?> </td>
                                <td class="text-right"> $ <?php echo number_format($subtotales['subtotal'], 2) ?> </td>
                            </tr>

                        <?php } ?>

                        <tr>
                            <td class="text-right" colspan="3"> <strong>Total</strong> </td>
                            <td class="text-right"> $ <?php echo number_format($total, 2) ?></td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
        <div style="border-top: 1px solid #f4f4f4; padding: 10px; text-align: center;">
            <div style="padding-bottom: 5px;" class="box-footer">
                <button style="padding-bottom: 5px;" type="button" class="button rounded" id="btnRegistro" value="pagar">Agregar</button>
            </div>
            <div id="paypal-button-container"></div>
        </div>
    </div>
</div>