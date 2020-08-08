<?php
include_once 'global/config.php';
include_once 'util/bd_conexion_pdo.php';
include_once 'util/Sesion.php';
include_once 'modelo/modelo-boleto.php';
include_once 'modelo/modelo-venta_articulo.php';
include_once 'modelo/modelo-venta.php';;

class VentaControlador
{

    public function insertarPreCompra($idSesión, $email)
    {
        $conexion = new Conexion();
        $conn = $conexion->conectarPDO();

        $respuesta = null;

        $sesion = new Sesion(); // Clase para manejar las sesion
        $venta_articulo = new VentaArticuloModelo();
        $boleto = new BoletoModelo(); // Modelo para realizar consular a la db respecto a Boleto
        $ventaModelo = new VentaModelo();

        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            $total_pre = $sesion->total();

            // Creamos la venta 
            $idventa = $ventaModelo->crear($conn, $idSesión, '{}', $email, $total_pre, 'pendiente');

            // Vinculamos e insertamos los articulos con venta
            if ($sesion->existeArticulos()) {
                foreach ($sesion->leerArticulos() as $idArticulo => $arrayArticulo) {
                    $venta_articulo->crear($conn, $idventa, $idArticulo, $arrayArticulo['cantidad']);
                }
            }

            // Creamos los boletos
            if ($sesion->existePlanes()) {
                foreach ($sesion->leerPlanes() as $idPlan => $arrayPlan) {
                    foreach ($arrayPlan[N_ASISTENTES_PLAN] as $indice => $arrayAsistente) {
                        if (!$boleto->crearVincular(
                            $conn,
                            $arrayAsistente[N_NOMBRE_ASISTENTE],
                            $arrayAsistente[N_APELLIDOPA_ASISTENTE],
                            $arrayAsistente[N_APELLIDOMA_ASISTENTE],
                            $arrayAsistente[N_EMAIL_ASISTENTE],
                            $arrayAsistente[N_TELEFONO_ASISTENTE],
                            $arrayAsistente[N_DOC_IDENTIDAD_ASISTENTE],
                            $idventa,
                            $idPlan,
                            $sesion->existeRegalo($idPlan, $indice) ? $arrayAsistente[N_REGALO_ASISTENTE][N_ID_REGALO] : null
                        )) {
                            throw new Exception("No se insertó el boleto");
                        }
                    }
                }
            }

            $conn->commit(); // Guadamos los cambios

            $respuesta =  json_encode(array(
                'respuesta' => 'exito',
                'mensaje' => "Guardado Satisfactoriamente",
                'idSesion' => $idSesión,
                'idventa' => $idventa,
                'total' => $total_pre
            ));
        } catch (\Throwable $e) {
            $conn->rollBack(); // Revertimos los cambios
            $respuesta = json_encode(array(
                'respuesta' => 'error',
                'mensaje' => $e->getMessage()
            ));
        }
        $conn = null;
        $conexion = null;

        return $respuesta;
    }

    public function solicitoInfoVenta($paymentID)
    {
        $objRespuesta = json_decode($this->myInfoPaypal());

        $accessToken = $objRespuesta->access_token;

        $venta = curl_init(LINKAPI . "/v1/payments/payment/" . $paymentID); // COnsultamos a Paypal sobre el pago realizado según el paymentID
        curl_setopt($venta, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $accessToken));

        curl_setopt($venta, CURLOPT_RETURNTRANSFER, TRUE);

        $paypal_datos = curl_exec($venta);

        curl_close($venta);

        return $paypal_datos;
    }

    private function myInfoPaypal()
    {
        $login = curl_init(LINKAPI . "/v1/oauth2/token");

        curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE); // la API devuelve la información que le estamos solicitando

        curl_setopt($login, CURLOPT_USERPWD, CLIENTID . ":" . SECRETID);

        curl_setopt($login, CURLOPT_POSTFIELDS, "grant_type=client_credentials"); // solicitarle la información de todas las credenciales que utiliza el ClientID y SecretID

        $respuesta = curl_exec($login);

        curl_close($login);

        return $respuesta;
    }
}
