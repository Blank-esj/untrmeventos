<?php
include_once 'controlador/global/config.php';
include_once 'controlador/util/bd_conexion_pdo.php';
include_once 'controlador/util/Sesion.php';
include_once 'boleto.php';
include_once 'venta_articulo.php';

class Venta
{

    public function insertarPreCompra($idSesión, $email)
    {
        $conexion = new Conexion();
        $conn = $conexion->conectarPDO();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            $sesion = new Sesion(); // Clase para manejar las sesion
            $venta_articulo = new VentaArticulo();
            $boleto = new Boleto(); // Modelo para realizar consular a la db respecto a Boleto

            $total_pre = $sesion->total();

            // Creamos la venta 
            $idventa = $this->crear($conn, $idSesión, '', $email, $total_pre, 'pendiente');

            // Vinculamos e insertamos los articulos con venta
            if ($sesion->existeArticulos()) {
                foreach ($sesion->leerArticulos() as $idArticulo => $arrayArticulo) {
                    $venta_articulo->crear($conn, $idventa, $idArticulo, $arrayArticulo['cantidad']);
                }
            }

            // Creamos los boletos
            if ($sesion->existePlanes()) {
                foreach ($sesion->leerPlanes() as $idPlan => $arrayPlan) {
                    foreach ($arrayPlan[N_ASISTENTES_PLAN] as $indice => $arrayAsistente) {
                        $boleto->crear(
                            $conn,
                            $arrayAsistente[N_NOMBRE_ASISTENTE],
                            $arrayAsistente[N_APELLIDOPA_ASISTENTE],
                            $arrayAsistente[N_APELLIDOMA_ASISTENTE],
                            $arrayAsistente[N_EMAIL_ASISTENTE],
                            $arrayAsistente[N_TELEFONO_ASISTENTE],
                            $arrayAsistente[N_DOC_IDENTIDAD_ASISTENTE],
                            $idventa,
                            $idPlan,
                            $sesion->existeRegalo($idPlan, $indice) ? $arrayAsistente[N_REGALO_ASISTENTE][N_ID_REGALO] : null
                        );
                    }
                }
            }

            $conn->commit(); // Guadamos los cambios

            return json_encode(array(
                'respuesta' => 'exito',
                'mensaje' => "Guardado Satisfactoriamente",
                'idSesion' => $idSesión,
                'idventa' => $idventa,
                'total' => $total_pre
            ));
        } catch (PDOException $e) {
            $conn->rollBack(); // Revertimos los cambios
            return json_encode(array(
                'respuesta' => 'error',
                'mensaje' => $e->getMessage()
            ));
        }
        $conn = null;
        $conexion = null;
    }

    /**
     * Inserta un registro venta con los datos que le pasemos y devuelve el id de la venta
     */
    public function crear(
        \PDO $conexion,
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

        $sentencia->closeCursor();
        return $conexion->lastInsertId();
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
}
