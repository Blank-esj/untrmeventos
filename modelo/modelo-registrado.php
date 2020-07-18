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
$articulos = $_POST['articulos'];

if ($_POST['registro'] == 'nuevo') {
    try {
        /* crear una sentencia preparada */
        $stmt = $conn->prepare("CALL sp_crear_boleto (?, ?, ?, ?, ?, ?, ?, ?, ?) ");

        /* ligar parámetros para marcadores */
        $stmt->bind_param("ssssssiis", $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad, $idplan, $idregalo, $descripcion);

        /* ejecutar la consulta */
        $stmt->execute();

        $id_insertado = $stmt->insert_id;

        $temporal = $stmt->affected_rows;

        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado,
                'otro' => $stmt,
                'temporal' => $temporal,
                'idregalo' => $idregalo,
                'datos' => array(
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
                )
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
