<?php
class VentaArticulo
{

    /**
     * Inserta un articulo en la base de datos según los parámetros que le pasemos 
     * y retorna el id del articulo creado
     */
    public function crear(\PDO $conexion, int $idventa, int $idarticulo, float $cantidad)
    {
        $sentencia = $conexion->prepare("INSERT INTO venta_articulo (
            idventa,
            idarticulo,
            cantidad) VALUES (
                :idventa, 
                :idarticulo, 
                :cantidad);");

        $sentencia->bindParam(":idventa", $idventa);
        $sentencia->bindParam(":idarticulo", $idarticulo);
        $sentencia->bindParam(":cantidad", $cantidad);
        $sentencia->execute();

        return $conexion->lastInsertId();
    }
}
