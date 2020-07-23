<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once 'controlador/funciones-evento.php';
include_once 'controlador/bd_conexion_pdo.php';
include_once 'controlador/util/Sesion.php';

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
            (new Sesion())->agregarPlan(
                openssl_decrypt($_POST['id'], COD, KEY),
                $nombre,
                openssl_decrypt($_POST['precio'], COD, KEY)
            );
            $mensaje = "El plan <strong>" . $nombre . "</strong> agregado a su carrito";
            break;
        case '':
            break;
        default:
            # code...
            break;
    }
}
