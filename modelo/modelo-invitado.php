<?php
    error_reporting(E_ALL^E_NOTICE);
    include_once '../controlador/funciones-admin.php';
    
    $id_registro = $_POST['id_registro'];          // idpersona
    $nombre = $_POST['nombre_invitado'];           // nombres
    $apellidopa = $_POST['apellidopa_invitado'];   // apellidopa
    $apellidoma = $_POST['apellidoma_invitado'];   // apellidoma
    $email = $_POST['email'];                      // email
    $direccion = $_POST['direccion'];              // direccion
    $telefono = $_POST['telefono'];                // telefono
    $celular = $_POST['celular'];                  // celular
    $nacimiento = $_POST['nacimiento'];            // nacimiento
    $biografia = $_POST['biografia_invitado'];

    //Código para insertar evento a la BD.
    if($_POST['registro'] == 'nuevo') {
        $directorio = "../vista/assets/img/invitados/";
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
            $stmt = $conn->prepare("CALL sp_crear_invitado (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()); ");
            $stmt->bind_param("ssssssssss", $nombre, $apellidopa, $apellidoma, $email, $direccion, $telefono, $celular, $nacimiento, $biografia, $imagen_url);
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
        } catch(Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        die(json_encode($respuesta));     
    }

    //Código para insertar un nuevo evento en la BD.
    if($_POST['registro'] == 'actualizar') { 

        $directorio = "../vista/assets/img/invitados/";

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
                $stmt = $conn->prepare("CALL sp_actualizar_invitado(?,?,?,?,?,?,?,?,?,?,?,NOW())");
                $stmt->bind_param("issssssssss", $id_registro, $nombre, $apellidopa, $apellidoma, $email, $direccion, $telefono, $celular, $nacimiento, $biografia, $imagen_url);
            } else {
                //sin imagen 
                $stmt = $conn->prepare("CALL sp_actualizar_invitado_simagen(?,?,?,?,?,?,?,?,?,?,NOW())");
                $stmt->bind_param("isssssssss", $id_registro, $nombre, $apellidopa, $apellidoma, $email, $direccion, $telefono, $celular, $nacimiento, $biografia);
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
            $stmt = $conn->prepare("DELETE FROM persona WHERE idpersona = ? ");
            $stmt->bind_param('i', $id_borrar);
            $stmt->execute();            
            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_eliminado' => $id_borrar,
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
