<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once '../controlador/funciones-evento.php';
include_once '../controlador/bd_conexion_pdo.php';

include_once 'controllers/boleto.php';

if ($_POST['registro'] == 'nuevo') {
    $boleto = new ControladorBoleto();
    die($boleto->guardarBoleto($_POST));
}

/*
if ($_POST['registro'] == 'actualizar') {
    try {
        $stmt = $conn->prepare("CALL sp_actualizar_registrado (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, 1 ) ");
        $stmt->bind_param("issssssssssis", $id_registro, $nombre, $apellidopa, $apellidoma, $email, $direccion, $telefono, $celular, $nacimiento, $pedido, $registro_eventos, $regalo, $total);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $id_registro
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}

if ($_POST['registro'] == 'eliminar') {
    $id_borrar = $_POST['id'];
    try {
        $stmt = $conn->prepare("DELETE FROM persona WHERE idpersona = ? ");
        $stmt->bind_param('i', $id_borrar);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}*/
