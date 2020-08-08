<?php
class PlanModelo
{
    /**
     * Devuelve un array con todos los planes que haya en la base de datos
     */
    public function leerPlanes()
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->query('SELECT * FROM plan;');
        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Leer un registro de plan de acuerdo al idplan que le pases
     */
    public function leer($idplan)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("SELECT * FROM plan WHERE idplan = :idplan");
        $sentencia->bindParam(":idplan", $idplan, PDO::PARAM_INT);
        $sentencia->execute();

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }
    /**
     * Leer todos los registros de planes odenados descendente o ascendente según el precio.
     * @param bool $descendente Si esta variable es true retornará los planes ordenados
     * descendentemente de acuerdo al precio si es false lo ordenará ascendentemente
     */
    public function leerOrdenadoPrecio(bool $descendente = true)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->query("SELECT * FROM plan ORDER BY precio " . ($descendente ? "DESC" : "ASC"));

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Crea un plan y devuelve true en caso se haya ejecutado con éxito sino devuelve false
     */
    public function crear(string $nombre, float $precio, string $descripcion, array $beneficios = [])
    {
        include_once 'controlador/util/bd_conexion_pdo.php';
        include_once 'controlador/global/config.php';

        $conn = (new Conexion())->conectarPDO();

        try {

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            $planCreado = $this->insertar($conn, $nombre, $precio, $descripcion);

            if ($planCreado['filas'] > 0) {

                include_once 'modelo/modelo-plan-beneficio.php';
                $beneficioModelo = new PlanBeneficioModelo();

                foreach ($beneficios as $id_cryp_beneficio) {
                    $idbeneficio = openssl_decrypt($id_cryp_beneficio, COD, KEY);

                    if ($beneficioModelo->crear($conn, $planCreado['id'], $idbeneficio)['filas'] <= 0) {
                        throw new Exception("No se insertó Beneficio");
                    }
                }

                $conn->commit(); // Guadamos los cambios
                $conn = null;
                return true;
            } else {
                throw new Exception("No se insertó Plan");
            }
        } catch (\Throwable $th) {
            $conn->rollBack(); // Revertimos los cambios
            $conn = null;
            return false;
        }
        $conn = null;
        return false;
    }

    private function insertar(\PDO &$conexion, $nombre, $precio, $descripcion)
    {
        $sentencia = $conexion->prepare("INSERT INTO plan (nombre, precio, descripcion) VALUES (:nombre, :precio, :descripcion);");
        $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $sentencia->bindParam(":precio", $precio);
        $sentencia->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $sentencia->execute();

        $resultado['id'] = $conexion->lastInsertId();
        $resultado['filas'] = $sentencia->rowCount();

        $sentencia = null;

        return $resultado;
    }

    public function actualizar(int $idplan, string $nombre, float $precio, string $descripcion, array $beneficios = [])
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();

        try {

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            $actualizoPlan = $this->update($conn, $idplan, $nombre, $precio, $descripcion);

            if ($actualizoPlan >= 0) {

                if ($actualizoPlan == 0) {
                    if ($this->leer($idplan)[0] != array("idplan" => $idplan, "nombre" => $nombre, "precio" => $precio, "descripcion" => $descripcion)) {
                        throw new Exception("No se actualizó plan");
                    }
                }

                include_once 'modelo/modelo-plan-beneficio.php';
                $planBeneficioModelo = new PlanBeneficioModelo();

                // Preguntamos si tiene algún registro
                // Si tiene lo eliminamos y creamos nuevos registros de pla-beneficio

                if (count($planBeneficioModelo->leerUnoPorPlan($idplan)) > 0) {
                    if ($planBeneficioModelo->eliminarPorPlan($conn, $idplan) <= 0) {
                        throw new Exception("Error al actualizar los beneficios");
                    }
                }

                foreach ($beneficios as $id_cryp_beneficio) {
                    $idbeneficio = openssl_decrypt($id_cryp_beneficio, COD, KEY);

                    if ($planBeneficioModelo->crear($conn, $idplan, $idbeneficio)['filas'] <= 0) {
                        throw new Exception("No se insertó Beneficio");
                    }
                }

                $conn->commit(); // Guadamos los cambios
                $conn = null;
                return true;
            } else {
                throw new Exception("No se actualizó Plan");
            }
        } catch (\Throwable $th) {
            $conn->rollBack(); // Revertimos los cambios
            $conn = null;
            return false;
        }
        $conn = null;
        return false;
    }


    /**
     * Actualiza un plan y devuelve el numero de filas afectadas
     */
    private function update(\PDO &$conexion, $idplan, $nombre, $precio, $descripcion)
    {
        $sentencia = $conexion->prepare(
            "UPDATE plan 
            SET nombre = :nombre ,
            precio = :precio ,
            descripcion = :descripcion 
            WHERE ( idplan = :idplan );"
        );

        $sentencia->bindParam(":idplan", $idplan, PDO::PARAM_INT);
        $sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $sentencia->bindParam(":precio", $precio);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;

        return $resultado;
    }

    /**
     * Elimina el registro de acuerdo al id del plan que le pasemos y devuelve el numero de filas afectadas
     */
    public function eliminar($idplan)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("DELETE FROM plan WHERE idplan = :idplan");
        $sentencia->bindParam(':idplan', $idplan);

        $sentencia->execute();

        $sentencia->closeCursor();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Devuelve los articulos [idboleto, idplan, nombre, precio, cantidad] que haya en una venta
     */
    public function leerPorVenta($idventa)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("CALL sp_plan_por_venta ( :idventa );");
        $sentencia->bindParam(':idventa', $idventa, PDO::PARAM_INT);

        $sentencia->execute();

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }
}
