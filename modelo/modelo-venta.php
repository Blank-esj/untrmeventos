<?php
class VentaModelo
{

    /**
     * Inserta un registro venta con los datos que le pasemos y devuelve el id de la venta
     */
    public function crear(
        PDO $conexion,
        string $clave_transaccion,
        $paypal_datos,
        string $correo,
        float $total_pre,
        string $estado
    ) {
        $sentencia = $conexion->prepare("INSERT INTO venta (
            clave_transaccion, 
            paypal_datos, 
            correo, 
            total_pre, 
            estado) VALUES (
                :clave_transaccion, 
                :paypal_datos, 
                :correo, 
                :total_pre, 
                :estado);");

        $sentencia->bindParam(":clave_transaccion", $clave_transaccion);
        $sentencia->bindParam(":paypal_datos", $paypal_datos);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->bindParam(":total_pre", $total_pre);
        $sentencia->bindParam(":estado", $estado);

        $sentencia->execute();

        $resultado = $conexion->lastInsertId();

        $sentencia->closeCursor();

        return $resultado;
    }

    /**
     * Actualiza el atributo estado de la tabla venta a aprobado.
     * Lo que significaría que el pago ha salido con éxito pero aún falta completarlo
     */
    public function aprobarVenta(int $idventa, string $paypal_datos, $estado = 'aprobado')
    {
        $conn = (new Conexion())->conectarPDO();
        $sentencia = $conn->prepare(
            "UPDATE venta SET 
            paypal_datos = :paypal_datos, 
            estado = :estado 
            WHERE ( idventa = :idventa );"
        );

        $sentencia->bindParam(":paypal_datos", $paypal_datos, PDO::PARAM_STR);
        $sentencia->bindParam(":estado", $estado, PDO::PARAM_STR);
        $sentencia->bindParam(":idventa", $idventa, PDO::PARAM_INT);
        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conn = null;

        return $resultado;
    }

    /**
     * Cambia el estado de la venta dandolo por completado tomando en cuenta a; idventa, clave de transacción y el total
     */
    public function completarVenta($idventa, $clave_transaccion, $total_pre, $estado = 'completo')
    {
        $conn = (new Conexion())->conectarPDO();
        $sentencia = $conn->prepare(
            "UPDATE venta SET 
            estado = :estado
            WHERE idventa = :idventa
            AND clave_transaccion = :clave_transaccion
            AND total_pre = :total_pre;"
        );

        $sentencia->bindParam(":idventa", $idventa);
        $sentencia->bindParam(":clave_transaccion", $clave_transaccion);
        $sentencia->bindParam(":total_pre", $total_pre);
        $sentencia->bindParam(":estado", $estado);
        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conn = null;

        return $resultado;
    }

    /**
     * Devuelve todas las ventas
     */
    public function leerTodos()
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion)->conectarPDO();

        $sentencia = $conexion->query("SELECT * FROM v_venta");

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }
}
