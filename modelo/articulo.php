<?php
class Articulo
{
    /**
     * Devuelve un array con todos los articulos existentes en la base de datos
     */
    public function leerTodos(\PDO $conexion)
    {
        $sentencia = $conexion->query('SELECT * FROM articulo;');
        $sentencia->closeCursor();
        return $sentencia;
    }

    /**
     * lee un registro de usuario de acuerdo al id que le pasemos y devuelve un array con los resultados
     */
    public function leerUno(\PDO $conexion, $idarticulo)
    {
        $sentencia = $conexion->prepare('SELECT * FROM articulo WHERE idarticulo = :idarticulo;');
        $sentencia->bindParam(':idarticulo', $idarticulo, PDO::PARAM_INT);
        $sentencia->execute();
        $resultado = ($sentencia->fetchAll(PDO::FETCH_ASSOC))[0];
        $sentencia->closeCursor();
        return $resultado;
    }

    /**
     * Actualiza el articulo de acuerdo al idarticulo que le pasemos y devuelve las filas afectadas
     */
    public function actualizar(\PDO $conexion, $idarticulo, $nombre_articulo, $precio, $stock, $descripcion, $url_imagen)
    {
        $sentencia = $conexion->prepare(
            "UPDATE articulo 
            SET nombre_articulo = :nombre_articulo, 
            precio = :precio, 
            stock = :stock, 
            descripcion = :descripcion, 
            url_imagen = :url_imagen 
            WHERE (idarticulo = :idarticulo);"
        );
        $sentencia->bindParam(':idarticulo', $idarticulo, PDO::PARAM_INT);
        $sentencia->bindParam(':nombre_articulo', $nombre_articulo, PDO::PARAM_INT);
        $sentencia->bindParam(':precio', $precio, PDO::PARAM_INT);
        $sentencia->bindParam(':stock', $stock, PDO::PARAM_INT);
        $sentencia->bindParam(':descripcion', $descripcion, PDO::PARAM_INT);
        $sentencia->bindParam(':url_imagen', $url_imagen, PDO::PARAM_INT);
        $sentencia->execute();
        $resultado = $sentencia->rowCount();
        $sentencia->closeCursor();
        return $resultado;
    }

    /**
     * Crea un articulo de acuerdo a los datos que le pasemos y devuelve el id de la tabla creada
     */
    public function crear(\PDO $conexion, $nombre_articulo, $precio, $stock, $descripcion, $url_imagen)
    {
        $sentencia = $conexion->prepare(
            "INSERT INTO articulo (
                nombre_articulo,
                precio,
                stock,
                descripcion,
                url_imagen
            ) VALUES (
                :nombre_articulo,
                :precio,
                :stock,
                :descripcion,
                :url_imagen);"
        );
        $sentencia->bindParam(':nombre_articulo', $nombre_articulo);
        $sentencia->bindParam(':precio', $precio);
        $sentencia->bindParam(':stock', $stock);
        $sentencia->bindParam(':descripcion', $descripcion);
        $sentencia->bindParam(':url_imagen', $url_imagen);
        $sentencia->execute();
        $resultado = $conexion->lastInsertId();
        $sentencia->closeCursor();
        return $resultado;
    }

    /**
     * Elimina el registro de acuerdo al id del articulo que le pasemos y devuelve las filas afectadas
     */
    public function eliminar(\PDO $conexion, $idarticulo)
    {
        $sentencia = $conexion->prepare("DELETE FROM articulo WHERE idarticulo = :idarticulo);");
        $sentencia->bindParam(':idarticulo', $idarticulo);
        $resultado = $sentencia->rowCount();
        $sentencia->closeCursor();
        return $resultado;
    }
}
