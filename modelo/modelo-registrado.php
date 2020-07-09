<?php
    error_reporting(E_ALL^E_NOTICE);
    include_once '../controlador/funciones-admin.php';
    
    $nombre = $_POST['nombre'];          // nombres
    $apellidopa = $_POST['apellidopa'];  // apellidopa
    $apellidoma = $_POST['apellidoma'];  // apellidoma
    $email = $_POST['email'];            // email
    $direccion = $_POST['direccion'];    // direccion
    $telefono = $_POST['telefono'];      // telefono
    $celular = $_POST['celular'];        // celular
    $nacimiento = $_POST['nacimiento'];  // nacimiento
    
    // boletos
    $boletos_adquiridos = $_POST['boletos'];

    // camisas y etiquetas
    $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
    $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];

    $pedido = productos_json($boletos_adquiridos, $camisas, $etiquetas); // pases_articulos

    $total = $_POST['total_pedido'];     // total_pagado
    $regalo = $_POST['regalo'];          // regalo

    $eventos = $_POST['registro_evento'];
    $registro_eventos = eventos_json($eventos); // taller_registrado

    $fecha_registro = $_POST['fecha_registro']; // fecha_registro
    $id_registro = $_POST['id_registro'];
    if($_POST['registro'] == 'nuevo'){
        try {
            $stmt = $conn->prepare("CALL sp_crear_registrado (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, 1 ) ");
            $stmt->bind_param("ssssssssssis", $nombre, $apellidopa, $apellidoma, $email, $direccion, $telefono, $celular, $nacimiento, $pedido, $registro_eventos, $regalo, $total);
            $stmt->execute();
            $id_insertado = $stmt->insert_id;
            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_insertado' => $id_insertado,3
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
            $stmt = $conn->prepare("CALL sp_actualizar_registrado (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, 1 ) ");
            $stmt->bind_param("issssssssssis", $id_registro, $nombre, $apellidopa, $apellidoma, $email, $direccion, $telefono, $celular, $nacimiento, $pedido, $registro_eventos, $regalo, $total);
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
            $stmt = $conn->prepare("DELETE FROM persona WHERE idpersona = ? ");
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
