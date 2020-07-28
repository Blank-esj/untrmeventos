<?php

include_once 'Sesion.php';
include_once 'bd_conexion_pdo.php';
include_once 'modelo/admins.php';

// Modificado: 16/07/2020 13:08
//Código para login de los administradores
if (isset($_POST['login-admin'])) {
    echo 'estoy evaluando el login';

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $conn = (new Conexion())->conectarPDO();

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

            $sesion->eliminarUsuario($admin['idpersona']);
        }
    }
}
