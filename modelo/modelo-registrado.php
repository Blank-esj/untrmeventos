<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once 'controlador/funciones-evento.php';
include_once 'controlador/bd_conexion_pdo.php';
include_once 'controlador/util/Sesion.php';
include_once 'controlador/debug_to_console.php';

include_once 'controllers/boleto.php'; // Es utilizado por este archivo

$conexion = new Conexion();
$mensaje = "";

if (isset($_POST['registro'])) {
    switch ($_POST['registro']) {
        case 'nuevo':
            $boleto = new ControladorBoleto();
            die($boleto->guardarBoleto($conexion, $_POST));
            break;
        case 'actualizar':

            break;
        case 'eliminar':

            break;
        case 'pagar':
            $pagar = new PagarBoleto();
            die($pagar->evaluarPago($conexion, $_POST));
            break;

        default:
            die(json_encode(array("respuesta" => "error", "mensaje" => "No entiendo tu petición")));
            break;
    }
} elseif (isset($_POST['registrarAsistente'])) {
    switch ($_POST['registrarAsistente']) {
        case 'seleccionaPlan':
            // Desencriptamos los datos enviados
            $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
            // Agregamos el plan a la sesión actual
            /*(new Sesion())->agregarPlan(
                openssl_decrypt($_POST['id'], COD, KEY),
                $nombre,
                openssl_decrypt($_POST['precion'], COD, KEY)
            );*/
            $mensaje = "El plan <strong>" . $nombre . "</strong> agregado a su carrito";
            break;
        case 'aumentarUnArticulo':
            // Desencriptar los datos que nos es enviado
            //$sesion = new Sesion();
            $id = openssl_decrypt($_POST['id'], COD, KEY);
            $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
            $precion = openssl_decrypt($_POST['precion'], COD, KEY);
            $stock = openssl_decrypt($_POST['stock'], COD, KEY);

            if (!isset($_SESSION['CARRITO'])) {
                $producto = array(
                    'ID' => $id,
                    'NOMBRE' => $nombre,
                    'PRECIO' => $precion
                );
                $_SESSION['CARRITO'][0] = $producto;
                print_r($_SESSION);
                $mensaje = "Producto agregado a carrito";
            } else {
                $idProdcutos = array_column($_SESSION['CARRITO'], "ID");

                if (in_array($id, $idProdcutos)) {
                    $mensaje = "$nombre ya está en el carrito";
                } else {
                    $numeroProductos = count($_SESSION['CARRITO']);
                    $producto = array(
                        'ID' => $id,
                        'NOMBRE' => $nombre,
                        'PRECIO' => $precion
                    );
                    $_SESSION['CARRITO'][$numeroProductos] = $producto;
                    $mensaje = "$nombre agregado a carrito";
                }
                print_r($_SESSION);
            }
            break;
        default:
            # code...
            break;
    }
}
