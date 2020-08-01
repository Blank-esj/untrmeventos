<?php
class EventoModelo
{

    /**
     * Se hace una consulta y se trae los resultados con fetchAll
     */
    public function leer($idevento)
    {
        include 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("SELECT * FROM evento WHERE id_evento = :id_evento");

        $sentencia->bindParam(":id_evento", $idevento, PDO::PARAM_INT);

        $sentencia->execute();

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Se hace una consulta y se trae los resultados con fetchAll
     */
    public function leerTodos()
    {
        include 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->query("SELECT * FROM evento");

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Devuelve un array con el id "id_evento" del evento creado y el número de filas afectadas "filas"
     */
    public function crear($nombre_evento, $fecha_evento, $hora_evento, $id_cat_evento, $id_inv, $clave)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare(
            "INSERT INTO evento (
            nombre_evento, 
            fecha_evento, 
            hora_evento, 
            id_cat_evento, 
            id_inv, 
            clave) VALUES (
                :nombre_evento,
                :fecha_evento,
                :hora_evento,
                :id_cat_evento,
                :id_inv,
                :clave );"
        );

        $sentencia->bindParam(":nombre_evento", $nombre_evento);
        $sentencia->bindParam(":fecha_evento", $fecha_evento);
        $sentencia->bindParam(":hora_evento", $hora_evento);
        $sentencia->bindParam(":id_cat_evento", $id_cat_evento);
        $sentencia->bindParam(":id_inv", $id_inv);
        $sentencia->bindParam(":clave", $clave);

        $sentencia->execute();

        $resultado['id_evento'] = $conexion->lastInsertId();
        $resultado['filas'] = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Devuelve el número de filas afectadas
     */
    public function actualizar($id_evento, $nombre_evento, $fecha_evento, $hora_evento, $id_cat_evento, $id_inv, $clave)
    {
        include 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare(
            "UPDATE evento SET 
                nombre_evento = :nombre_evento, 
                fecha_evento = :fecha_evento, 
                hora_evento = :hora_evento, 
                id_cat_evento = :id_cat_evento, 
                id_inv = :id_inv, 
                clave = :clave 
            WHERE id_evento = :id_evento;"
        );

        $sentencia->bindParam(":id_evento", $id_evento, PDO::PARAM_INT);
        $sentencia->bindParam(":nombre_evento", $nombre_evento, PDO::PARAM_STR);
        $sentencia->bindParam(":fecha_evento", $fecha_evento, PDO::PARAM_STR);
        $sentencia->bindParam(":hora_evento", $hora_evento, PDO::PARAM_STR);
        $sentencia->bindParam(":id_cat_evento", $id_cat_evento, PDO::PARAM_INT);
        $sentencia->bindParam(":id_inv", $id_inv, PDO::PARAM_INT);
        $sentencia->bindParam(":clave", $clave, PDO::PARAM_STR);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Devuelve el número filas afectadas
     */
    public function eliminar($id_evento)
    {
        include 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("DELETE FROM evento WHERE id_evento = :id_evento");

        $sentencia->bindParam(":id_evento", $id_evento, PDO::PARAM_INT);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }
}
