<?php
include_once '../controlador/funciones-admin.php';

$id_registro = $_POST['id_registro']; // idpersona
$nombres = $_POST['nombre'];          // nombres
$apellidopa = $_POST['apellidopa'];   // apellidopa
$apellidoma = $_POST['apellidoma'];   // apellidoma
$email = $_POST['email'];             // email
$direccion = $_POST['direccion'];     // direccion
$telefono = $_POST['telefono'];       // telefono
$celular = $_POST['celular'];         // celular
$nacimiento = $_POST['nacimiento'];   // nacimiento
$usuario = $_POST['usuario'];         // usuario
$password = $_POST['password'];       // password
$nivel = (int) $_POST['nivel'];       // nivel

//Código para insertar administradores a la BD.
if ($_POST['registro'] == 'nuevo') {
    //Código para hashear la contraseña
    //la opcion costo, mientras mas sea el costo más iteraciones para generar un password hasheado
    $opciones = array(
        'cost' => 12
    );
    /* función hash encripta el password y PASSWORD_BCRYPT es un algoritmo de encriptacion para generar 
        el password de 60 caracteres*/
    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

    try {
        $stmt = $conn->prepare("CALL sp_crear_administrador (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?) ");
        $stmt->bind_param("ssssssssssi", $nombres, $apellidopa, $apellidoma, $email, $direccion, $telefono, $celular, $nacimiento, $usuario, $password_hashed, $nivel);
        $stmt->execute();

        $id_registro = $stmt->insert_id;
        if ($stmt->affected_rows) {
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
    } catch (Exception $e) {

        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}

//Código para login de los administradores
if ($_POST['registro'] == 'actualizar') { //Si existe.

    try {
        if (empty($_POST['password'])) { //Valida si el campo CONTRASEÑA está vacío.
            //Si está vacío ACTUALIZAREMOS SOLAMENTE los  campos usuario y nombre.
            $stmt = $conn->prepare("CALL sp_actualizar_admins_sin(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
            $stmt->bind_param("isssssssssi", $id_registro, $nombres, $apellidopa, $apellidoma, $email, $direccion, $telefono, $celular, $nacimiento, $usuario, $nivel);
        } else {
            //Si el campo CONTRASEÑA tiene algo. ACTUALIZAREMOS TODOS LOS CAMPOS.
            $opciones = array(
                'cost' => 12
            );

            $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
            $stmt = $conn->prepare("CALL sp_actualizar_admins_sin(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
            $stmt->bind_param("issssssssssi", $id_registro, $nombres, $apellidopa, $apellidoma, $email, $direccion, $telefono, $celular, $nacimiento, $usuario, $hash_password, $nivel);
        }
        $stmt->execute();
        if ($stmt->affected_rows) {
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
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}
