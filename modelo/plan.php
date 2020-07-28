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
}
