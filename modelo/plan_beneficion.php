<?php
class PlanBeneficio
{
    /**
     * Devuelve un array con todos los registros de grado de instrucción existentes en la base de datos
     */
    public function leerPlanBeneficios($conexion): array
    {
        $sentencia = $conexion->prepare('SELECT * FROM grado_instruccion;');
        $sentencia->execute();
        $resutado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia->closeCursor();
        return $resutado;
    }

    /**
     * Leer un registro de plan_beneficio de acuerdo al idplan_beneficio que le pases
     */
    public function leerUno(\PDO $conexion, $idplan_beneficio)
    {
        $sentencia = $conexion->prepare("SELECT * FROM plan_beneficio WHERE idplan_beneficio = :idplan_beneficio");
        $sentencia->bindParam(":idplan_beneficio", $idplan_beneficio, PDO::PARAM_INT);
        $sentencia->execute();
        $sentencia->closeCursor();
        return ($sentencia->fetchAll(PDO::FETCH_ASSOC))[0];
    }

    /**
     * Crea un plan_beneficio y devuelve su id
     */
    public function crear(\PDO $conexion, $idplan, $idbeneficio)
    {
        $sentencia = $conexion->prepare("INSERT INTO plan_beneficio (idplan, idbeneficio) VALUES (:idplan, :idbeneficio);");
        $sentencia->bindParam(":idplan", $idplan, PDO::PARAM_INT);
        $sentencia->bindParam(":idbeneficio", $idbeneficio, PDO::PARAM_INT);
        $sentencia->execute();
        $sentencia->closeCursor();
        return $conexion->lastInsertId();
    }

    /**
     * Actualiza un plan_beneficio y devuelve el numero de filas afectadas
     */
    public function actualizar(\PDO $conexion, $idplan_beneficio, $idplan, $idbeneficio)
    {
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
        $sentencia->closeCursor();
        return $sentencia->rowCount();
    }

    /**
     * Elimina el registro de acuerdo al id del plan_beneficio que le pasemos y devuelve el numero de filas afectadas
     */
    public function eliminar(\PDO $conexion, $idplan_beneficio)
    {
        $sentencia = $conexion->prepare("DELETE FROM plan_beneficio WHERE idplan_beneficio = :idplan_beneficio);");
        $sentencia->bindParam(':idplan_beneficio', $idplan_beneficio);
        $sentencia->closeCursor();
        return $sentencia->rowCount();
    }
}
