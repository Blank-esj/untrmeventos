<?php
class VentaArticuloModelo
{

    /**
     * Inserta un articulo en la base de datos según los parámetros que le pasemos 
     * y retorna el id del articulo creado
     */
    public function crear(\PDO &$conexion, int $idventa, int $idarticulo, float $cantidad)
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

        $sentencia->closeCursor();

        return $conexion->lastInsertId();
    }

    public function leerPorVenta($idventa)
    {
        include_once 'modelo/modelo-venta_articulo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("SELECT * FROM v_venta_articulo WHERE idventa = :idventa");

        $sentencia->bindParam(":idventa", $idventa);

        $sentencia->execute();

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }
}
