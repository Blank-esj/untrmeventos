<?php
include_once 'controlador/global/config.php';

$conn = new mysqli(SERVIDOR, USUARIO, CONTRASENA, BASEDATOS);

if ($conn->connect_error) {
    echo $error->$conn->connect_error;
}

$conn->set_charset("utf8");
