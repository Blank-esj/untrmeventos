<?php
class CategoriaEventoModelo
{
    /**
     * Retona un conjunto de resultados de acuerdo al id que le pases
     */
    public function leer(\PDO &$conexion, int $id)
    {
        $sentencia = $conexion->prepare("SELECT * FROM categoria_evento WHERE id_categoria = :id_categoria");

        $sentencia->bindParam(":id_categoria", $id, PDO::PARAM_INT);

        $sentencia->execute();

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia->closeCursor();

        return $resultado;
    }

    /**
     * Retorna un array conteniendo a todos los registros
     */
    public function leerTodos(\PDO &$conexion)
    {
        $sentencia = $conexion->query("SELECT * FROM categoria_evento");

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia->closeCursor();

        return $resultado;
    }

    /**
     * Crea un nuevo registro de acuerdo de acuerdo lo que le pases
     */
    public function crear(\PDO &$conexion, string $cat_evento, string $icono)
    {
        $sentencia = $conexion->prepare("INSERT INTO categoria_evento (cat_evento, icono) VALUES (:cat_evento, :icono);");

        $sentencia->bindParam(":cat_evento", $cat_evento, PDO::PARAM_STR);
        $sentencia->bindParam(":icono", $icono, PDO::PARAM_STR);

        $sentencia->execute();

        $sentencia->closeCursor();

        return $conexion->lastInsertId();
    }

    /**
     * Actualiza un determinado registro de acuerdo a las variables que le pases
     */
    public function actualizar(\PDO &$conexion, int $id, string $cat_evento, string $icono)
    {
        $sentencia = $conexion->prepare(
            "UPDATE categoria_evento 
            SET cat_evento = :cat_evento, 
            icono = :icono 
            WHERE (id_categoria = :id_categoria);"
        );

        $sentencia->bindParam(":cat_evento", $cat_evento, PDO::PARAM_STR);
        $sentencia->bindParam(":icono", $icono, PDO::PARAM_STR);
        $sentencia->bindParam(":id_categoria", $id, PDO::PARAM_INT);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia->closeCursor();

        return $resultado;
    }

    /**
     * Elimina un registro de la base de datos de acuerdo al id que le pases
     */
    public function eliminar(\PDO &$conexion, int $id)
    {
        $sentencia = $conexion->prepare("DELETE FROM categoria_evento WHERE (id_categoria = :id_categoria);");

        $sentencia->bindParam(":id_categoria", $id, PDO::PARAM_INT);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia->closeCursor();

        return $resultado;
    }
}
