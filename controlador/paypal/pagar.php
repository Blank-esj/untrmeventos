<?php

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

class PagarBoleto
{
      public function evaluarPago($conexionBD, $post)
      {
            require 'paypal.php';
            $conn = $conexionBD->conectarPDO();
            try {
                  $boleto = new ControladorBoleto();
                  $compra = new Payer();
                  $pedidoPlan = new Item(); // creamos un objeto Item para el Plan
                  $pedidoArticulo = new Item();
                  $listaPedido = new ItemList(); // almacena el plan y los articulos
                  $datosArticulos = array();
                  $cantidad = new Amount();
                  $total = 0; // total a pagar
                  $transaccion =  new Transaction();
                  $redireccionar = new RedirectUrls();
                  $idboleto = 3; // id del boleto registrado
                  $pago = new Payment();

                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

                  $compra->setPaymentMethod('paypal');

                  // Realiza una consulta a la base de datos y pregunta por el nombre y precio del plan y guarda el nombre
                  $datosPlan = $boleto->obtenerNombrePrecioPlan($conn, $post['idplan']);

                  $pedidoPlan->setName($datosPlan['nombre'])
                        ->setCurrency('USD')
                        ->setQuantity(1)
                        ->setPrice($datosPlan['precio']);

                  $listaPedido->addItem($pedidoPlan); // Añadimos el plan a la lista de Pedidos

                  $total += $datosPlan['precio']; // sumamos lo que valga el plan

                  if ($post['articulos']) {
                        $datosArticulos = $boleto->obtenerArticulos($conn, $post['articulos']);

                        foreach ($datosArticulos as $articulo) {
                              $pedidoArticulo->setName($articulo['nombre_articulo'])
                                    ->setCurrency('USD')
                                    ->setQuantity($post[$articulo['idarticulo']])
                                    ->setPrice($articulo['precio']);

                              $total += $articulo['precio']; // Sumamos lo que valga el articulo

                              $listaPedido->addItem($pedidoArticulo);
                        }
                  }

                  $cantidad->setCurrency('USD')
                        ->setTotal($total);

                  $transaccion->setAmount($cantidad)
                        ->setItemList($listaPedido)
                        ->setDescription('Pago UNTRM - Eventos ')
                        ->setInvoiceNumber($idboleto);

                  try {
                        $redireccionar->setReturnUrl(URL_SITIO . "http://localhost:8080/untrmeventos/vista/pago_finalizado.php?exito=true&id_pago={$idboleto}")
                              ->setCancelUrl(URL_SITIO . "http://localhost:8080/untrmeventos/vista/pago_finalizado.php?exito=false&id_pago={$idboleto}");
                  } catch (Exception $ex) {
                        //throw new Exception($ex->getMessage());
                        throw new Exception($ex->getMessage());
                  }

                  /*$redireccionar->setReturnUrl(URL_SITIO . "/pago_finalizado.php?exito=true&id_pago={$idboleto}")
                        ->setCancelUrl(URL_SITIO . "/pago_finalizado.php?exito=false&id_pago={$idboleto}");*/
                  /*
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

                  header("Location: {$aprobado}");*/

                  $conn->commit(); // Guadamos los cambios

                  return json_encode(array(
                        'respuesta' => 'exito',
                        'mensaje' => "Guardado Satisfactoriamente",
                        'datosPlan' => $datosPlan,
                        'datosArticulos' => $datosArticulos,
                        'listaPedido' => $listaPedido->getItems()
                  ));
            } catch (PDOException $e) {
                  $conn->rollBack(); // Revertimos los cambios
                  return json_encode(array(
                        'respuesta' => 'error',
                        'mensaje' => $e->getMessage(),
                        'datosPlan' => $datosPlan,
                        'datosArticulos' => $datosArticulos,
                        'listaPedido' => $listaPedido->getItems()
                  ));
            }
            $conn = null;
      }
}
