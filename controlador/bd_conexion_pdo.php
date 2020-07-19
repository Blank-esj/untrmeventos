<?php
class Conexion
{
    private $servidor;
    private $basedatos;
    private $usuario;
    private $contrasena;
    private $dsn;

    public function __construct()
    {
        include_once('keys.php');
        $this->servidor = $host;
        $this->basedatos = $database;
        $this->usuario = $user;
        $this->contrasena = $password;
        $this->dsn = ($dsn) ? $dsn : "mysql:dbname=$this->basedatos;servidor=$this->servidor"; // Se establece a Mysql como controlador por defecto
    }

    public function conectarPDO(): PDO
    {
        try {
            return new PDO($this->dsn, $this->usuario, $this->contrasena, array(
                PDO::ATTR_PERSISTENT => true // conexiones persistentes
            ));
        } catch (PDOException $e) {
            throw new PDOException('Coneccion fallida: ' . $e->getMessage() . " dsn: " . $this->dsn);
        }
    }

    public function getServidor(): string
    {
        return $this->servidor;
    }

    public function getBaseDatos(): string
    {
        return $this->basedatos;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function getContrasena(): string
    {
        return $this->contrasena;
    }
}
