<?php
class ArticuloModelo
{
    /**
     * Devuelve un array con todos los articulos existentes en la base de datos
     */
    public function leerTodos()
    {

        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->query('SELECT * FROM articulo;');

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $conexion = null;
        $sentencia = null;

        return $resultado;
    }

    /**
     * lee un registro de usuario de acuerdo al id que le pasemos y devuelve un array con los resultados
     */
    public function leerUno($idarticulo)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare('SELECT * FROM articulo WHERE idarticulo = :idarticulo;');
        $sentencia->bindParam(':idarticulo', $idarticulo, PDO::PARAM_INT);
        $sentencia->execute();
        $resultado = ($sentencia->fetchAll(PDO::FETCH_ASSOC))[0];

        $conexion = null;
        $sentencia = null;

        return $resultado;
    }

    /**
     * Actualiza el articulo de acuerdo al idarticulo que le pasemos y devuelve las filas afectadas
     */
    public function actualizar(int $idarticulo, string $nombre_articulo, float $precio, float $stock, string $descripcion, string $url_imagen = null)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $consulta = "UPDATE articulo 
            SET nombre_articulo = :nombre_articulo, 
            precio = :precio, 
            stock = :stock, 
            descripcion = :descripcion "
            . ($url_imagen != null ? ", url_imagen = :url_imagen " : "") .
            "WHERE idarticulo = :idarticulo;";

        $sentencia = $conexion->prepare($consulta);

        $sentencia->bindParam(':idarticulo', $idarticulo);
        $sentencia->bindParam(':nombre_articulo', $nombre_articulo);
        $sentencia->bindParam(':precio', $precio);
        $sentencia->bindParam(':stock', $stock);
        $sentencia->bindParam(':descripcion', $descripcion);

        if ($url_imagen != null) {
            $sentencia->bindParam(':url_imagen', $url_imagen);
        }

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Crea un articulo de acuerdo a los datos que le pasemos y devuelve el id de la tabla creada
     */
    public function crear(string $nombre_articulo, float $precio, float $stock, string $descripcion, string $url_imagen = null)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

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
        $sentencia->bindParam(':nombre_articulo', $nombre_articulo, PDO::PARAM_STR);
        $sentencia->bindParam(':precio', $precio);
        $sentencia->bindParam(':stock', $stock);
        $sentencia->bindParam(':descripcion', $descripcion);
        $sentencia->bindParam(':url_imagen', $url_imagen);

        $sentencia->execute();

        $resultado['filas'] = $sentencia->rowCount();
        $resultado['id'] = $conexion->lastInsertId();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Elimina el registro de acuerdo al id del articulo que le pasemos y devuelve las filas afectadas
     */
    public function eliminar($idarticulo)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("DELETE FROM articulo WHERE idarticulo = :idarticulo;");
        $sentencia->bindParam(':idarticulo', $idarticulo);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }
}
