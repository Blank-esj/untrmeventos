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

$nombre = $post['nombre'];
$apellidopa = $post['apellidopa'];
$apellidoma = $post['apellidoma'];
$email = $post['email'];
$regalo = $post['regalo'];
$total = $post['total_pedido'];
$fecha = date('Y-m-d H:i:s');
$boletos = $post['boletos'];
$numero_boletos = $boletos;
$pedidoExtra = $post['pedido_extra'];
$camisas = $post['pedido_extra']['camisas']['cantidad'];
$precioCamisa = $post['pedido_extra']['camisas']['precio'];
$etiquetas = $post['pedido_extra']['etiquetas']['cantidad'];
$precioEtiquetas = $post['pedido_extra']['etiquetas']['precio'];
include_once 'includes/funciones/funciones.php';
$pedido = productos_json($boletos, $camisas, $etiquetas);
$eventos = $post['registro'];
$registro = eventos_json($eventos);
try {
      require_once('includes/funciones/bd_conexion.php');
      $stmt = $conn->prepare("INSERT INTO registrado (nombre_registrado, apellidopa_registrado, apellidoma_registrado, email_registrado, fecha_registro, pases_articulos, taller_registrado, regalo, total_pagado) VALUES (?,?,?,?,?,?,?,?,?) ");
      $stmt->bind_param("sssssssis", $nombre, $apellidopa, $apellidoma, $email, $fecha, $pedido, $registro, $regalo, $total);
      $stmt->execute();
      $id_registro = $stmt->insert_id;
      $stmt->close();
      $conn->close();
} catch (Exception $e) {
      $error = $e->getMessage();
}


$compra = new Payer();
$compra->setPaymentMethod('paypal');

$articulo = new Item();
$articulo->setName($producto)
      ->setCurrency('MXN')
      ->setQuantity(1)
      ->setPrice($precio);

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
$redireccionar->setReturnUrl(URL_SITIO . "/pago_finalizado.php?exito=true&id_pago={$id_registro}")
      ->setCancelUrl(URL_SITIO . "/pago_finalizado.php?exito=false&id_pago={$id_registro}");

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
