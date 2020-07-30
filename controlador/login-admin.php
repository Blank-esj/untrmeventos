<?php

include_once 'util/Sesion.php';
include_once 'util/bd_conexion_pdo.php';
include_once 'modelo/admins.php';

// Modificado: 16/07/2020 13:08
//Código para login de los administradores
function verificarUsuarioPassword($usuario, $password)
{
    $conn = (new Conexion())->conectarPDO();

    $admin = new Admins();

    if ($admin->cuentaAdmins($conn) > 0) {

        $admin = ((new Admins())->leerDatosLoginAdmin($conn, $usuario));

        if (count($admin) > 0) {

            if (password_verify($password, $admin['password'])) {
                $sesion = new Sesion();

                $sesion->agregarUsuario(
                    $admin['idpersona'],
                    $usuario,
                    $password,
                    $admin['nombre_completo'],
                    $admin['nivel']
                );
                unset($sesion);
                return true;
            } else return false;
        } else return false;
    }else return false;
}
