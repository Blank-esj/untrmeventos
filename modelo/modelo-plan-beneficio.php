<?php
class PlanBeneficioModelo
{
    /**
     * Devuelve un array con todos los registros de grado de instrucción existentes en la base de datos
     */
    public function leerPlanBeneficios(): array
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare('SELECT * FROM grado_instruccion;');
        $sentencia->execute();

        $resutado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;
        return $resutado;
    }

    /**
     * Leer un registro de plan_beneficio de acuerdo al idplan_beneficio que le pases
     */
    public function leerUno($idplan_beneficio)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("SELECT * FROM plan_beneficio WHERE idplan_beneficio = :idplan_beneficio");
        $sentencia->bindParam(":idplan_beneficio", $idplan_beneficio, PDO::PARAM_INT);
        $sentencia->execute();

        $resutado = ($sentencia->fetchAll(PDO::FETCH_ASSOC));

        $sentencia = null;
        $conexion = null;
        return $resutado;
    }

    /**
     * Leer un registro de plan_beneficio de acuerdo al idplan_beneficio que le pases
     */
    public function leerUnoPorPlan($idplan)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("SELECT * FROM plan_beneficio WHERE idplan = :idplan");
        $sentencia->bindParam(":idplan", $idplan, PDO::PARAM_INT);
        $sentencia->execute();

        $resutado = ($sentencia->fetchAll(PDO::FETCH_ASSOC));

        $sentencia = null;
        $conexion = null;
        return $resutado;
    }

    /**
     * Crea un plan_beneficio y devuelve su id y el número de filas afectadas
     */
    public function crear(\PDO $conexion, $idplan, $idbeneficio)
    {

        $sentencia = $conexion->prepare("INSERT INTO plan_beneficio (idplan, idbeneficio) VALUES (:idplan, :idbeneficio);");
        $sentencia->bindParam(":idplan", $idplan, PDO::PARAM_INT);
        $sentencia->bindParam(":idbeneficio", $idbeneficio, PDO::PARAM_INT);
        $sentencia->execute();

        $resutado['filas'] = $sentencia->rowCount();
        $resutado['id'] = $conexion->lastInsertId();

        $sentencia = null;
        
        return $resutado;
    }

    /**
     * Actualiza un plan_beneficio y devuelve el numero de filas afectadas
     */
    public function actualizar($idplan_beneficio, $idplan, $idbeneficio)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare(
            "UPDATE plan_beneficio 
            SET idplan = :idplan ,
            idbeneficio = :idbeneficio , 
            WHERE ( idplan_beneficio = :idplan_beneficio);"
        );
        $sentencia->bindParam(":idplan_beneficio", $idplan_beneficio, PDO::PARAM_INT);
        $sentencia->bindParam(":idplan", $idplan, PDO::PARAM_INT);
        $sentencia->bindParam(":idbeneficio", $idbeneficio, PDO::PARAM_INT);
        $sentencia->execute();

        $resutado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;
        return $resutado;
    }

    /**
     * Elimina el registro de acuerdo al id del plan_beneficio que le pasemos y devuelve el numero de filas afectadas
     */
    public function eliminar($idplan_beneficio)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("DELETE FROM plan_beneficio WHERE idplan_beneficio = :idplan_beneficio);");
        $sentencia->bindParam(':idplan_beneficio', $idplan_beneficio);

        $sentencia->execute();

        $resutado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;
        return $resutado;
    }

    /**
     * Elimina el registro de acuerdo al id del plan que le pasemos y devuelve el numero de filas afectadas
     */
    public function eliminarPorPlan(\PDO $conexion, $idplan)
    {
        $sentencia = $conexion->prepare("DELETE FROM plan_beneficio WHERE idplan = :idplan ;");
        $sentencia->bindParam(':idplan', $idplan);

        $sentencia->execute();

        $resutado = $sentencia->rowCount();

        echo var_dump($resutado);
        echo var_dump($idplan);

        $sentencia = null;

        return $resutado;
    }

    /**
     * Devuelve un array con todos los beneficios del plan
     */
    public function beneficioPlan($idplan)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("CALL sp_beneficios_plan ( :idplan );");
        $sentencia->bindParam(':idplan', $idplan);

        $sentencia->execute();

        $resutado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;
        return $resutado;
    }
}
