<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once '../controlador/funciones-evento.php';
include_once '../controlador/bd_conexion_pdo.php';
include_once 'controllers/boleto.php';
include_once '../controlador/paypal/pagar.php';

$conexion = new Conexion();

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
