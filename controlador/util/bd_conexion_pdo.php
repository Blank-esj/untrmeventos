<?php
include_once 'controlador/global/config.php';
class Conexion
{
    public function conectarPDO(): PDO
    {
        try {
            return new PDO("mysql:dbname=" . BASEDATOS . ";host=" . SERVIDOR, USUARIO, CONTRASENA, array(
                //PDO::ATTR_PERSISTENT => true, // conexiones persistentes
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
            ));
        } catch (PDOException $e) {
            throw new PDOException('Coneccion fallida: ' . $e->getMessage());
        }
    }
}
