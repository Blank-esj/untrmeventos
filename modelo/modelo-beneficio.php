<?php
class BeneficioModelo
{
    /**
     * Leer un registro de Beneficio de acuerdo al idbeneficio que le pases
     */
    public function leerUno($idbeneficio)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("SELECT * FROM beneficio WHERE idbeneficio = :idbeneficio");
        $sentencia->bindParam(":idbeneficio", $idbeneficio, PDO::PARAM_INT);
        $sentencia->execute();

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Devuelve todos los beneficios que haya en la base de datos
     */
    public function leerTodos()
    {
        include_once 'controlador/util/bd_conexion_pdo.php';
        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->query('SELECT * FROM beneficio;');

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Crea un beneficio y devuelve un array con el id "id" y las filas afectadas "filas"
     */
    public function crear($nombre)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';
        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("INSERT INTO beneficio (nombre) VALUES (:nombre);");
        $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $sentencia->execute();

        $resultado['id'] = $conexion->lastInsertId();
        $resultado['filas'] = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Actualiza un beneficio y devuelve el numero de filas afectadas
     */
    public function actualizar($idbeneficio, $nombre)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';
        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("UPDATE beneficio SET nombre = :nombre WHERE idbeneficio = :idbeneficio");
        $sentencia->bindParam(":idbeneficio", $idbeneficio, PDO::PARAM_INT);
        $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Elimina el registro de acuerdo al id del beneficio que le pasemos y devuelve el numero de filas afectadas
     */
    public function eliminar($idbeneficio)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';
        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("DELETE FROM beneficio WHERE idbeneficio = :idbeneficio");
        $sentencia->bindParam(':idbeneficio', $idbeneficio);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }
}
