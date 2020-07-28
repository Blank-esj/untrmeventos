<?php
class Beneficio
{
    /**
     * Devuelve todos los beneficios que haya en la base de datos
     */
    public function leerBeneficios(\PDO $conexion)
    {
        $sentencia = $conexion->query('SELECT * FROM beneficio;');
        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia->closeCursor();
        return $resultado;
    }
}
