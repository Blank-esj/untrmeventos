<?php
class GradoInstruccionModelo
{
    /**
     * Leer un registro de Grado_instruccion de acuerdo al idgrado_instruccion que le pases
     */
    public function leerUno($idgrado_instruccion)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("SELECT * FROM grado_instruccion WHERE idgrado_instruccion = :idgrado_instruccion");
        $sentencia->bindParam(":idgrado_instruccion", $idgrado_instruccion, PDO::PARAM_INT);
        $sentencia->execute();

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Devuelve todos los grados_instruccion que haya en la base de datos
     */
    public function leerTodos()
    {
        include_once 'controlador/util/bd_conexion_pdo.php';
        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->query('SELECT * FROM grado_instruccion;');

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Crea un grado_instruccion y devuelve un array con el id "id" y las filas afectadas "filas"
     */
    public function crear($grado)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';
        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("INSERT INTO grado_instruccion (grado) VALUES (:grado);");
        $sentencia->bindParam(":grado", $grado, PDO::PARAM_STR);
        $sentencia->execute();

        $resultado['id'] = $conexion->lastInsertId();
        $resultado['filas'] = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Actualiza un grado_instruccion y devuelve el numero de filas afectadas
     */
    public function actualizar($idgrado_instruccion, $grado)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';
        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("UPDATE grado_instruccion SET grado = :grado WHERE idgrado_instruccion = :idgrado_instruccion");
        $sentencia->bindParam(":idgrado_instruccion", $idgrado_instruccion, PDO::PARAM_INT);
        $sentencia->bindParam(":grado", $grado, PDO::PARAM_STR);
        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Elimina el registro de acuerdo al id del grado_instruccion que le pasemos y devuelve el numero de filas afectadas
     */
    public function eliminar($idgrado_instruccion)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';
        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("DELETE FROM grado_instruccion WHERE idgrado_instruccion = :idgrado_instruccion");
        $sentencia->bindParam(':idgrado_instruccion', $idgrado_instruccion);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }
}
