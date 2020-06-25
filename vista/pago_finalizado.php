<?php include_once '/plantillas/header-evento.php';

use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payment;

require_once '../controlador/paypal/paypal.php';
?>
<section class="seccion contenedor">
  <h2>Resumen Registro</h2>

  <?php
  $resultado = $_GET['exito'];
  $paymentId = $_GET['paymentId'];
  $id_pago = (int) $_GET['id_pago'];

  //peticion a REST API
  $pago = Payment::get($paymentId, $apiContext);
  $execution = new PaymentExecution();
  $execution->setPayerId($_GET['PayerID']);

  //resultado tiene la informacion de la transaccion
  $resultado = $pago->execute($execution, $apiContext);

  $respuesta = $resultado->transactions[0]->related_resources[0]->sale->state;

  if ($respuesta == "completed") {
    echo "<div class='resultado correcto'>";
    echo "Registro Exitoso!!! <br/>";
    echo "<i class='far fa-thumbs-up'></i> <br/>";
    echo "El pago se realizó correctamente <br/>";
    echo "el ID es {$paymentId}";
    echo "</div>";

    require_once('../controlador/bd_conexion.php');
    $stmt = $conn->prepare("UPDATE registrado SET pagado = ? WHERE id_registrado = ? ");
    $pagado = 1;
    $stmt->bind_param("ii", $pagado, $id_pago);
    $stmt->execute();
    $stmt->close();
    $conn->close();
  } else {
    echo "<div class='resultado error'>";
    echo "El pago no se realizo";
    echo "</div>";
  }
  ?>
</section>
<?php include_once '/plantillas/footer-evento.php'; ?>