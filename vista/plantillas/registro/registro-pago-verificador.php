<?php

include_once 'controlador/controlador-venta.php';

$ventaModelo = new VentaModelo();

$paypal_datos = (new VentaControlador())->solicitoInfoVenta($_POST['paymentID']);

$objDatosTransaccion = json_decode($paypal_datos);

$nombres = $objDatosTransaccion->payer->payer_info->first_name;

$state = $objDatosTransaccion->state;
$total = $objDatosTransaccion->transactions[0]->amount->total;
$custom = $objDatosTransaccion->transactions[0]->custom;

$clave = explode("#", $custom);

$clave_transaccion = $clave[0];
$idventa = (int)openssl_decrypt($clave[1], COD, KEY);

if ($state == "approved") {
    $mensajePaypal = "<h3>Pago aprobado</h3>";

    $ventaModelo->aprobarVenta($idventa, $paypal_datos);

    $completado = $ventaModelo->completarVenta($idventa, $clave_transaccion, $total);

    session_destroy();
} else {
    $mensajePaypal = "<h3>Hay un problema con el pago de paypal</h3>";
}
?>

<div class="jumbotron jumbotron-fluid text-center">
    <h1 class="display-4">¡Listo! </h1>
    <hr class="my-4">
    <p class="lead"><?php echo $mensajePaypal ?></p>
    <p>
        <?php
        if ($completado > 0) {
            $completado = null;

            echo "<h1> $nombres haz completado tu pago!! </h1>";
        }
        ?>

    </p>
</div>