<?php
    error_reporting(E_ALL^E_NOTICE);
    include_once '../controlador/funciones-admin.php';
    
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $id_registro = $_POST['id_registro'];
    $nivel = (int) $_POST['nivel'];

    //Código para insertar administradores a la BD.
    if($_POST['registro'] == 'nuevo') {
        //Código para hashear la contraseña
        //la opcion costo, mientras mas sea el costo más iteraciones para generar un password hasheado
        $opciones = array(
          'cost' => 12
        );
        /* función hash encripta el password y PASSWORD_BCRYPT es un algoritmo de encriptacion para generar 
        el password de 60 caracteres*/
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

        try {  
            $stmt = $conn->prepare("INSERT INTO admins (usuario, nombre, password, editado, nivel) VALUES (?, ?, ?, NOW(), ?) ");
            $stmt->bind_param("sssi", $usuario, $nombre, $password_hashed, $nivel);
            $stmt->execute();

            $id_registro = $stmt->insert_id;
            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_admin' => $id_registro,
                    'stmt' => $stmt->$sqlstate
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

    //Código para login de los administradores
    if($_POST['registro'] == 'actualizar') { //Si existe.

        try {
            if(empty($_POST['password'])) { //Valida si el campo CONTRASEÑA está vacío.
                //Si está vacío ACTUALIZAREMOS SOLAMENTE los  campos usuario y nombre.
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, editado = NOW(), nivel = ?  WHERE id_admin = ? ");
                $stmt->bind_param("ssii", $usuario, $nombre, $nivel, $id_registro);
            } else {
                //Si el campo CONTRASEÑA tiene algo. ACTUALIZAREMOS TODOS LOS CAMPOS.
                $opciones = array(
                    'cost' => 12
                );
    
                $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, password = ?, editado = NOW(), nivel = ? WHERE id_admin = ? ");
                $stmt->bind_param("sssii", $usuario, $nombre, $hash_password, $nivel, $id_registro);
            }
            $stmt->execute();
            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    //'id_actualizado' => $stmt->insert_id
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

    //Código para eliminar un administradores
    if($_POST['registro'] == 'eliminar') {
        $id_borrar = $_POST['id'];
        try {
            $stmt = $conn->prepare("DELETE FROM admins WHERE id_admin = ? ");
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
