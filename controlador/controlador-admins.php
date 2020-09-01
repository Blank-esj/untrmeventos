<?php

function crearA(
    $nombres,
    $apellidopa,
    $apellidoma,
    $email = null,
    $telefono = null,
    $doc_identidad = null,
    $usuario,
    $contrasena,
    $nivel
) {
    include 'util/mensaje.php';

    $modelo = new AdministradorModelo();

    try {

        $contrasena_hasheada = password_hash($contrasena, PASSWORD_BCRYPT, array('cost' => 12));

        if ($modelo->crear($nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad, $usuario, $contrasena_hasheada, $nivel)) {

            mensaje("<strong>" . $nombres . "</strong> se guardó satisfactoriamente", "success");
            return true;
        } else
            throw new PDOException("Error al crear");
    } catch (Exception $e) {
        mensaje("Lo siento hubo un error al crear el administrador: <br/>" . $e->getMessage(), "error");
        return false;
    }
    return false;
}

function actualizarA(
    $idpersona,
    $nombres,
    $apellidopa,
    $apellidoma,
    $email = null,
    $telefono = null,
    $doc_identidad = null,
    $usuario,
    $contrasena,
    $nivel
) {
    include 'util/mensaje.php';

    $modelo = new AdministradorModelo();

    try {

        if ($contrasena != null)
            $contrasena = password_hash($contrasena, PASSWORD_BCRYPT, array('cost' => 12));

        if ($modelo->actualizar($idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad, $usuario, $contrasena, $nivel)) {
            mensaje("<strong>" . $nombres . "</strong> se actualizó satisfactoriamente", "success");
            return true;
        } else
            throw new PDOException("Error al actualizar <strong>" . $nombres . "</strong>");
    } catch (Exception $e) {
        mensaje("Lo siento hubo un error al actualizar el administrador: <br/>" . $e->getMessage(), "error");
        return false;
    }
    return false;
}


function eliminarA($id)
{
    include 'util/mensaje.php';

    $modelo = new AdministradorModelo();

    try {
        if ($modelo->eliminar($id) > 0) {
            mensaje("Eliminado satisfactoriamente", "success");
        } else {
            throw new Exception("Error al eliminar este administrador");
        }
    } catch (Throwable $th) {
        mensaje("Lo siento hubo un error al eliminar el administrador: <br/>" . $th->getMessage(), "error");
    }
}
