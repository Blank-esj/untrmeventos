<?php
class Beneficio
{
    /**
     * Devuelve todos los beneficios que haya en la base de datos
     */
    public function leerTodos(\PDO $conexion)
    {
        $sentencia = $conexion->query('SELECT * FROM beneficio;');
        $sentencia->closeCursor();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Leer un registro de Beneficio de acuerdo al idbeneficio que le pases
     */
    public function leerUno(\PDO $conexion, $idbeneficio)
    {
        $sentencia = $conexion->prepare("SELECT * FROM beneficio WHERE idbeneficio = :idbeneficio");
        $sentencia->bindParam(":idbeneficio", $idbeneficio, PDO::PARAM_INT);
        $sentencia->execute();
        $sentencia->closeCursor();
        return ($sentencia->fetchAll(PDO::FETCH_ASSOC))[0];
    }

    /**
     * Crea un beneficio y devuelve su id
     */
    public function crear(\PDO $conexion, $nombre)
    {
        $sentencia = $conexion->prepare("INSERT INTO beneficio (nombre) VALUES (:nombre);");
        $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $sentencia->execute();
        $sentencia->closeCursor();
        return $conexion->lastInsertId();
    }

    /**
     * Actualiza un beneficio y devuelve el numero de filas afectadas
     */
    public function actualizar(\PDO $conexion, $idbeneficio, $nombre)
    {
        $sentencia = $conexion->prepare("UPDATE beneficio SET nombre = :nombre WHERE ( idbeneficio = :idbeneficio);");
        $sentencia->bindParam(":idbeneficio", $idbeneficio, PDO::PARAM_INT);
        $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $sentencia->execute();
        $sentencia->closeCursor();
        return $sentencia->rowCount();
    }

    /**
     * Elimina el registro de acuerdo al id del beneficio que le pasemos y devuelve el numero de filas afectadas
     */
    public function eliminar(\PDO $conexion, $idbeneficio)
    {
        $sentencia = $conexion->prepare("DELETE FROM beneficio WHERE idbeneficio = :idbeneficio);");
        $sentencia->bindParam(':idbeneficio', $idbeneficio);
        $resultado = $sentencia->rowCount();
        $sentencia->closeCursor();
        return $resultado;
    }
}
