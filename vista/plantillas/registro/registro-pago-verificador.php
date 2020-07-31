<?php

$ventaModelo = new Venta();

$login = curl_init(LINKAPI . "/v1/oauth2/token");

curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE); // la API devuelve la información que le estamos solicitando

curl_setopt($login, CURLOPT_USERPWD, CLIENTID . ":" . SECRETID);

curl_setopt($login, CURLOPT_POSTFIELDS, "grant_type=client_credentials"); // solicitarle la información de todas las credenciales que utiliza el ClientID y SecretID

$respuesta = curl_exec($login);

$objRespuesta = json_decode($respuesta);

$accessToken = $objRespuesta->access_token;

$venta = curl_init(LINKAPI . "/v1/payments/payment/" . $_POST['paymentID']); // COnsultamos a Paypal sobre el pago realizado según el paymentID
curl_setopt($venta, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $accessToken));

curl_setopt($venta, CURLOPT_RETURNTRANSFER, TRUE);

$paypal_datos = curl_exec($venta);

$objDatosTransaccion = json_decode($paypal_datos);

$nombres = $objDatosTransaccion->payer->payer_info->first_name;
// $email = $objDatosTransaccion->payer->payer_info->email;
// $currency = $objDatosTransaccion->transactions[0]->amount->currency;

$state = $objDatosTransaccion->state;
$total = $objDatosTransaccion->transactions[0]->amount->total;
$custom = $objDatosTransaccion->transactions[0]->custom;

$clave = explode("#", $custom);

$clave_transaccion = $clave[0];
$idventa = (int)openssl_decrypt($clave[1], COD, KEY);

curl_close($login);
curl_close($venta);

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