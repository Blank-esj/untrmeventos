<?php
class Plan
{
    /**
     * Devuelve un array con todos los planes que haya en la base de datos
     */
    public function leerPlanes(\PDO $conexion)
    {
        $sentencia = $conexion->query('SELECT * FROM plan;');
        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia->closeCursor();
        return $resultado;
    }

    /**
     * Leer un registro de plan de acuerdo al idplan que le pases
     */
    public function leerUno(\PDO $conexion, $idplan)
    {
        $sentencia = $conexion->prepare("SELECT * FROM plan WHERE idplan = :idplan");
        $sentencia->bindParam(":idplan", $idplan, PDO::PARAM_INT);
        $sentencia->execute();
        $sentencia->closeCursor();
        return ($sentencia->fetchAll(PDO::FETCH_ASSOC))[0];
    }

    /**
     * Crea un plan y devuelve su id
     */
    public function crear(\PDO $conexion, $nombre, $precio, $descripcion)
    {
        $sentencia = $conexion->prepare("INSERT INTO plan (nombre, precio, descripcion) VALUES (:nombre, :precio, :descripcion);");
        $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $sentencia->bindParam(":precio", $precio);
        $sentencia->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $sentencia->execute();
        $sentencia->closeCursor();
        return $conexion->lastInsertId();
    }

    /**
     * Actualiza un plan y devuelve el numero de filas afectadas
     */
    public function actualizar(\PDO $conexion, $idplan, $nombre, $precio, $descripcion)
    {
        $sentencia = $conexion->prepare(
            "UPDATE plan 
            SET nombre = :nombre ,
            precio = :precio ,
            descripcion = :descripcion 
            WHERE ( idplan = :idplan);"
        );
        $sentencia->bindParam(":idplan", $idplan, PDO::PARAM_INT);
        $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $sentencia->bindParam(":precio", $precio);
        $sentencia->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $sentencia->execute();
        $sentencia->closeCursor();
        return $sentencia->rowCount();
    }

    /**
     * Elimina el registro de acuerdo al id del plan que le pasemos y devuelve el numero de filas afectadas
     */
    public function eliminar(\PDO $conexion, $idplan)
    {
        $sentencia = $conexion->prepare("DELETE FROM plan WHERE idplan = :idplan);");
        $sentencia->bindParam(':idplan', $idplan);
        $sentencia->closeCursor();
        return $sentencia->rowCount();
    }
}
