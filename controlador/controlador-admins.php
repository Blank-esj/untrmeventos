<?php

function verificarUsuarioPassword($usuario, $password)
{
    include_once 'util/Sesion.php';
    include_once 'util/bd_conexion_pdo.php';
    include_once 'modelo/modelo-admins.php';

    $conn = (new Conexion())->conectarPDO();

    $admin = new AdminsModelo();

    if ((int)$admin->cuentaAdmins($conn)[0]['total'] > 0) {

        $admin = ((new AdminsModelo())->leerDatosLoginAdmin($usuario));

        $conn = null;

        if (count($admin) > 0) {

            if (isset($admin[0]['password'])) {

                if (password_verify($password, $admin[0]['password'])) {
                    $sesion = new Sesion();

                    $sesion->agregarUsuario(
                        $admin[0]['idpersona'],
                        $usuario,
                        $password,
                        $admin[0]['nombre_completo'],
                        $admin[0]['nivel']
                    );
                    $admin = null;
                    return true;
                } else return false;
            } else return false;
        } else return false;
    } else return false;
}

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
    include_once 'modelo/modelo-administrador.php';
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

    include_once 'modelo/modelo-administrador.php';
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
    include 'modelo/modelo-administrador.php';
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
