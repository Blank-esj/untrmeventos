<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once '../controlador/funciones-admin.php';
include_once '../controlador/debug_to_console.php';

$nombres = $_POST['nombres'];
$apellidopa = $_POST['apellidopa'];
$apellidoma = $_POST['apellidoma'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$doc_identidad = $_POST['doc_identidad'];
$idplan = $_POST['idplan'];
$idregalo = $_POST['idregalo'];
$descripcion = $_POST['descripcion'];
$articulos = json_encode($_POST['articulos']);

if ($_POST['registro'] == 'nuevo') {
    try {
        $datos = array(
            'nombres' => $nombres,
            'apellidopa' => $apellidopa,
            'apellidoma' => $apellidoma,
            'email' => $email,
            'telefono' => $telefono,
            'doc_identidad' => $doc_identidad,
            'idplan' => $idplan,
            'idregalo' => $idregalo,
            'descripcion' => $descripcion,
            'articulos' => $articulos
        );

        // Especifica si se ha seleccionado un regalo
        if (intval($idregalo)) {
            // Se llama al procedimiento que crea un boleto
            $stmt = $conn->prepare("CALL sp_crear_boleto (?, ?, ?, ?, ?, ?, ?, ?, ?) ");

            /* ligar parámetros para marcadores */
            $stmt->bind_param("ssssssiis", $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad, $idplan, $idregalo, $descripcion);
        } else {
            // Se llama al procedimiento que crea un boleto SIN REGALO
            $stmt = $conn->prepare("CALL sp_crear_boleto_sinregalo (?, ?, ?, ?, ?, ?, ?, ?) ");

            /* ligar parámetros para marcadores */
            $stmt->bind_param("ssssssis", $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad, $idplan, $descripcion);
        }

        /* ejecutar la consulta */
        if ($stmt->execute()) {
            $respuesta = array(
                'respuesta' => 'exito',
                'datos' => $datos
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'datos' => $datos
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
}
