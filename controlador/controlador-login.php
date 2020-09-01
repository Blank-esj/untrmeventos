
<?php

function verificarUsuarioPassword($usuario, $password)
{
    include_once 'util/Sesion.php';
    include_once 'util/bd_conexion_pdo.php';
    include_once 'modelo/modelo-administrador.php';

    $conn = (new Conexion())->conectarPDO();

    $admin = new AdministradorModelo();

    if ((int)$admin->cuentaAdmins($conn)[0]['total'] > 0) {

        $admin = ((new AdministradorModelo())->leerDatosLoginAdmin($usuario));

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
