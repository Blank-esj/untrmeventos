<?php
    error_reporting(E_ALL^E_NOTICE);
    include_once '../controlador/funciones-admin.php';
    
    $nombre = $_POST['nombre'];
    $apellidopa = $_POST['apellidopa'];
    $apellidoma = $_POST['apellidoma'];
    $email = $_POST['email'];

    // boletos
    $boletos_adquiridos = $_POST['boletos'];

    // camisas y etiquetas
    $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
    $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];

    $pedido = productos_json($boletos_adquiridos, $camisas, $etiquetas);

    $total = $_POST['total_pedido'];
    $regalo = $_POST['regalo'];

    $eventos = $_POST['registro_evento'];
    $registro_eventos = eventos_json($eventos);

    $fecha_registro = $_POST['fecha_registro'];
    $id_registro = $_POST['id_registro'];

    if($_POST['registro'] == 'nuevo'){
        try {
            $stmt = $conn->prepare("INSERT INTO registrado (nombre_registrado, apellidopa_registrado, apellidoma_registrado, email_registrado, fecha_registro, pases_articulos,     taller_registrado, regalo, total_pagado, pagado ) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?, 1 ) ");
            $stmt->bind_param("ssssssis", $nombre, $apellidopa, $apellidoma, $email, $pedido, $registro_eventos, $regalo, $total);
            $stmt->execute();
            $id_insertado = $stmt->insert_id;
            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_insertado' => $id_insertado,
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conn->close();
        } catch(Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        die(json_encode($respuesta));  
    }

    if($_POST['registro'] == 'actualizar'){  
        try {
            $stmt = $conn->prepare("UPDATE registrado SET nombre_registrado = ?, apellidopa_registrado = ?, apellidoma_registrado = ?,email_registrado = ?, fecha_registro = ?,     pases_articulos = ?, taller_registrado = ?, regalo = ?, total_pagado = ?, pagado = 1 WHERE id_registrado = ? " );
            $stmt->bind_param('sssssssisi', $nombre, $apellidopa, $apellidoma, $email, $fecha_registro, $pedido, $registro_eventos, $regalo, $total, $id_registro );
            $stmt->execute();
            if($stmt->affected_rows) {
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

    if($_POST['registro'] == 'eliminar'){
        $id_borrar = $_POST['id'];
        try {
            $stmt = $conn->prepare("DELETE FROM registrado WHERE id_registrado = ? ");
            $stmt->bind_param('i', $id_borrar);
            $stmt->execute();
            if($stmt->affected_rows) {
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
