<?php
    include_once '../controlador/funciones-admin.php';
    
    $titulo = $_POST['titulo_evento'];
    $id_categoria = $_POST['categoria_evento'];
    $id_invitado = $_POST['invitado'];
    //optenemos la fecha y cambiamos formato
    $fecha = $_POST['fecha_evento'];
    $fecha_formateada = date('Y-m-d', strtotime($fecha));
    //optenemos la hora
    $hora = $_POST['hora_evento'];
    $hora_formateada = date('H:i', strtotime($hora));
        
    $id_registro = $_POST['id_registro'];

    //Código para insertar evento a la BD.
    if($_POST['registro'] == 'nuevo') {
        try {
            $stmt = $conn->prepare("INSERT INTO evento (nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_inv) VALUES (?, ?, ?, ?, ?) ");
            $stmt->bind_param("sssii", $titulo, $fecha_formateada, $hora_formateada, $id_categoria, $id_invitado);
            $stmt->execute();

            $id_insertado = $stmt->insert_id;
            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_insertado' => $id_insertado,
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'Error'
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

    //Código para insertar un nuevo evento en la BD.
    if($_POST['registro'] == 'actualizar') { //Si existe.
        try {
            $stmt = $conn->prepare("UPDATE evento SET nombre_evento = ?, fecha_evento = ?, hora_evento = ?, id_cat_evento = ?, id_inv = ?, editado = NOW() WHERE id_evento = ? ");
            $stmt->bind_param("sssiii", $titulo, $fecha_formateada, $hora_formateada, $id_categoria, $id_invitado, $id_registro);         
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

    //Código para eliminar un evento
    if($_POST['registro'] == 'eliminar') {
        $id_borrar = $_POST['id'];
        try {
            $stmt = $conn->prepare("DELETE FROM evento WHERE id_evento = ? ");
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
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        die(json_encode($respuesta));
    }
