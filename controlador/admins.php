<?php

if (isset($_POST['dashboard'])) {

    //$dato = openssl_decrypt($_POST['dashboard'], COD, KEY);
    $dato = $_POST['dashboard'];

    switch ($dato) {

        case 'admin1-crear':

            $contrasena_hasheada = password_hash($_POST['contrasena'], PASSWORD_BCRYPT, array('cost' => 12));

            $adminsModelo->crear(
                $connPDO,
                $_POST['nombres'],
                $_POST['apellidopa'],
                $_POST['apellidoma'],
                $_POST['email'],
                $_POST['telefono'],
                $_POST['doc_identidad'],
                $_POST['usuario'],
                $contrasena_hasheada
            );

            break;
    }
}
