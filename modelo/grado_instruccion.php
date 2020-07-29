<?php
class GradoInstruccion
{
    /**
     * Devuelve un array con todos los registros de grado de instrucción existentes en la base de datos
     */
    public function leerGradoInstrucciones($conexion): array
    {
        $sentencia = $conexion->prepare('SELECT * FROM grado_instruccion;');
        $sentencia->execute();
        $resutado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia->closeCursor();
        return $resutado;
    }

    /**
     * Leer un registro de grado_instruccion de acuerdo al idgrado_instruccion que le pases
     */
    public function leerUno(\PDO $conexion, $idgrado_instruccion)
    {
        $sentencia = $conexion->prepare("SELECT * FROM grado_instruccion WHERE idgrado_instruccion = :idgrado_instruccion");
        $sentencia->bindParam(":idgrado_instruccion", $idgrado_instruccion, PDO::PARAM_INT);
        $sentencia->execute();
        $sentencia->closeCursor();
        return ($sentencia->fetchAll(PDO::FETCH_ASSOC))[0];
    }

    /**
     * Crea un grado_instruccion y devuelve su id
     */
    public function crear(\PDO $conexion, $grado)
    {
        $sentencia = $conexion->prepare("INSERT INTO grado_instruccion (grado) VALUES (:grado);");
        $sentencia->bindParam(":grado", $grado, PDO::PARAM_STR);
        $sentencia->execute();
        $sentencia->closeCursor();
        return $conexion->lastInsertId();
    }

    /**
     * Actualiza un grado_instruccion y devuelve el numero de filas afectadas
     */
    public function actualizar(\PDO $conexion, $idgrado_instruccion, $grado)
    {
        $sentencia = $conexion->prepare("UPDATE grado_instruccion SET grado = :grado WHERE ( idgrado_instruccion = :idgrado_instruccion);");
        $sentencia->bindParam(":idgrado_instruccion", $idgrado_instruccion, PDO::PARAM_INT);
        $sentencia->bindParam(":grado", $grado, PDO::PARAM_STR);
        $sentencia->execute();
        $sentencia->closeCursor();
        return $sentencia->rowCount();
    }

    /**
     * Elimina el registro de acuerdo al id del grado_instruccion que le pasemos y devuelve el numero de filas afectadas
     */
    public function eliminar(\PDO $conexion, $idgrado_instruccion)
    {
        $sentencia = $conexion->prepare("DELETE FROM grado_instruccion WHERE idgrado_instruccion = :idgrado_instruccion);");
        $sentencia->bindParam(':idgrado_instruccion', $idgrado_instruccion);
        $resultado = $sentencia->rowCount();
        $sentencia->closeCursor();
        return $resultado;
    }
}
