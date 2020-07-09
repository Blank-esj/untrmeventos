<?php

include_once '../controlador/debug_to_console.php';

if (!isset($_POST['submit'])) {
      exit("Hubo un error");
}

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require '../controlador/paypal/paypal.php';

if (isset($_POST['submit'])) :
      $nombre = $_POST['nombre'];
      $apellidopa = $_POST['apellidopa'];
      $apellidoma = $_POST['apellidoma'];
      $email = $_POST['email'];
      $regalo = $_POST['regalo'];
      $total = $_POST['total_pedido'];

      $fecha = date('Y-m-d H:i:s');
      $boletos = $_POST['boletos'];
      $numero_boletos = $boletos;
      $pedidoExtra = $_POST['pedido_extra'];
      $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
      $precioCamisa = $_POST['pedido_extra']['camisas']['precio'];
      $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
      $precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];

      include_once '../controlador/funciones-evento.php';
      $pedido = productos_json($boletos, $camisas, $etiquetas);
      $eventos = $_POST['registro'];
      $registro = eventos_json($eventos);
      try {
            require_once('../controlador/bd_conexion.php');
            $stmt = $conn->prepare("CALL sp_crear_registrado (?,?,?,?,NULL,NULL,NULL,NULL,?,?,?,?,?,0) ");
            $stmt->bind_param("sssssssis", $nombre, $apellidopa, $apellidoma, $email, $fecha, $pedido, $registro, $regalo, $total);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            $stmt->close();
            $conn->close();
      } catch (Exception $e) {
            $error = $e->getMessage();
      }
endif;

$compra = new Payer();
$compra->setPaymentMethod('paypal');

$articulo = new Item();
$articulo->setName('producto')
      ->setCurrency('MXN')
      ->setQuantity(1)
      ->setPrice($precio);

debug_to_console($articulo);

$i = 0;
$arreglo_pedido = array();
foreach ($numero_boletos as $key => $value) {
      if ((int) $value['cantidad'] > 0) {
            ${"articulos$i"} = new Item();
            $arreglo_pedido[] = ${"articulos$i"};
            ${"articulos$i"}->setName('Pase: ' . $key)
                  ->setCurrency('USD')
                  ->setQuantity((int) $value['cantidad'])
                  ->setPrice((int) $value['precio']);
            $i++;
      }
}

foreach ($pedidoExtra as $key => $value) {
      if ((int) $value['cantidad'] > 0) {
            if ($key == 'camisas') {
                  $precio = (float) $value['precio'] * .93;
            } else {
                  $precio = (int) $value['precio'];
            }
            ${"articulo$i"} = new Item();
            $arreglo_pedido[] = ${"articulo$i"};
            ${"articulo$i"}->setName('Extras: ' . $key)
                  ->setCurrency('USD')
                  ->setQuantity((int) $value['cantidad'])
                  ->setPrice($precio);
            $i++;
      }
}

$listaArticulos = new ItemList();
$listaArticulos->setItems($arreglo_pedido);

$cantidad = new Amount();
$cantidad->setCurrency('USD')
      ->setTotal($total);

$transaccion =  new Transaction();
$transaccion->setAmount($cantidad)
      ->setItemList($listaArticulos)
      ->setDescription('Pago UNTRM - Eventos ')
      ->setInvoiceNumber($id_registro);

$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO . "pago_finalizado.php?exito=true&id_pago={$id_registro}")
      ->setCancelUrl(URL_SITIO . "pago_finalizado.php?exito=false&id_pago={$id_registro}");

$pago = new Payment();
$pago->setIntent("sale")
      ->setPayer($compra)
      ->setRedirectUrls($redireccionar)
      ->setTransactions(array($transaccion));

try {
      $pago->create($apiContext);
} catch (PayPal\Exception\PayPalConnectionException $pce) {
      echo "<pre>";
      print_r(json_decode($pce->getData()));
      exit;
      echo "</pre>";
}

$aprobado = $pago->getApprovalLink();

header("Location: {$aprobado}");
