<?php

function crear(
    $nombres,
    $apellidopa,
    $apellidoma,
    $email,
    $telefono,
    $doc_identidad,
    $usuario,
    $contrasena
) {

    include 'modelo/modelo-admins.php';
    include 'util/mensaje.php';

    $modelo = new AdminsModelo();

    try {
        $contrasena_hasheada = password_hash($contrasena, PASSWORD_BCRYPT, array('cost' => 12));

        if ($modelo->crear($nombres, $apellidopa, $apellidoma,  $email, $telefono, $doc_identidad, $usuario, $contrasena_hasheada)['filas'] > 0) {
            mensaje("<strong>" . $nombres . "</strong> se guardó satisfactoriamente", "success");
            return true;
        } else {
            throw new Exception("No se pudo crear administrador ");
        }
    } catch (PDOException $th) {
        mensaje("Lo siento hubo un error al crear administrador", "error");
        return false;
    }
    return false;
}

// Modificado: 16/07/2020 13:08
//Código para login de los administradores
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
