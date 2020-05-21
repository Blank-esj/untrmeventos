<?php
    include_once 'funciones/funciones.php';
    $nombre = $_POST['nombre_invitado'];
    $apellidopa = $_POST['apellidopa_invitado'];
    $apellidoma = $_POST['apellidoma_invitado'];
    $biografia = $_POST['biografia_invitado'];
    $id_registro = $_POST['id_registro'];

    //Código para insertar evento a la BD.
    if($_POST['registro'] == 'nuevo') {
        $directorio = "../img/invitados/";
        if(!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        if(move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio . $_FILES['archivo_imagen']['name'])) {
            $imagen_url = $_FILES['archivo_imagen']['name'];
            $imagen_resultado = "Se subio correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }

        try {
            $stmt = $conn->prepare("INSERT INTO invitado (nombre_invitado, apellidopa_invitado, apellidoma_invitado, descripcion, url_imagen) VALUES (?, ?, ?, ?, ?) ");
            $stmt->bind_param("sssss", $nombre, $apellidopa, $apellidoma, $biografia, $imagen_url);
            $stmt->execute();
            $id_insertado = $stmt->insert_id;
            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_insertado' => $id_insertado,
                    'resultado_imagen' => $imagen_resultado
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

    //Código para insertar un nuevo evento en la BD.
    if($_POST['registro'] == 'actualizar') { 

        $directorio = "../img/invitados/";

        if(!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        if(move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio . $_FILES['archivo_imagen']['name'])) {
            $imagen_url = $_FILES['archivo_imagen']['name'];
            $imagen_resultado = "Se subió correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }

        try {
            if($_FILES['archivo_imagen']['size'] > 0) {
                //con imagen
                $stmt = $conn->prepare("UPDATE invitado SET nombre_invitado = ?, apellidopa_invitado = ?, apellidoma_invitado = ?, descripcion = ?, url_imagen = ? WHERE id_invitado = ? ");
                $stmt->bind_param("sssssi", $nombre, $apellidopa, $apellidoma, $biografia, $imagen_url, $id_registro);
            } else {
                //sin imagen 
                $stmt = $conn->prepare("UPDATE invitado SET nombre_invitado = ?, apellidopa_invitado = ?, apellidoma_invitado = ?, descripcion = ? WHERE id_invitado = ? ");
                $stmt->bind_param("ssssi", $nombre, $apellidopa, $apellidoma, $biografia, $id_registro);
            }         
            $estado = $stmt->execute();

            if($estado == true) {
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
            $stmt = $conn->prepare("DELETE FROM invitado WHERE id_invitado = ? ");
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
?>