<?php

class BoletoModelo
{

    /**
     * Crea un nuevo boleto sin tomar en cuenta los articulos y retorna el id del boleto creado
     * @param mixed $conexion objeto de la conexión a la base de datos
     * @param mixed $post array del método HTTP $_POST
     * @return string id del boleto creado
     */
    public function crear(
        \PDO $conexion,
        string $nombres,
        string $apellidopa,
        string $apellidoma,
        string $email,
        string $telefono,
        string $doc_identidad,
        int $idventa,
        int $idplan,
        int $idregalo = null
    ) {

        $consulta =
            ($idregalo == null ? "CALL sp_crear_boleto_sinregalo( " : "CALL sp_crear_boleto( ") .
            ":nombres,
            :apellidopa,
            :apellidoma,
            :email,
            :telefono,
            :doc_identidad,
            :idventa,
            :idplan"
            . ($idregalo == null ? "" : ", :idregalo") .
            ")";

        $sentencia = $conexion->prepare($consulta);

        $sentencia->bindParam(":nombres", $nombres);
        $sentencia->bindParam(":apellidopa", $apellidopa);
        $sentencia->bindParam(":apellidoma", $apellidoma);
        $sentencia->bindParam(":email", $email);
        $sentencia->bindParam(":telefono", $telefono);
        $sentencia->bindParam(":doc_identidad", $doc_identidad);
        $sentencia->bindParam(":idventa", $idventa);
        $sentencia->bindParam(":idplan", $idplan);

        if ($idregalo != null)
            $sentencia->bindParam(":idregalo", $idregalo);


        $sentencia->execute();

        $resultado['id'] = $conexion->lastInsertId();
        $resultado['filas'] = $sentencia->rowCount();

        $sentencia->closeCursor();
    }

    public function crearAceptandoNulos(
        string $nombres,
        string $apellidopa,
        string $apellidoma,
        string $email,
        string $telefono,
        string $doc_identidad,
        int $idventa,
        int $idplan,
        int $idregalo = null
    ) {

        include_once 'controlador/util/bd_conexion_pdo.php';
        
        $conexion = (new Conexion())->conectarPDO();

        $consulta =
            ($idregalo == null ? "CALL sp_crear_boleto_sinregalo( " : "CALL sp_crear_boleto( ") .
            ":nombres,
            :apellidopa,
            :apellidoma,
            :email,
            :telefono,
            :doc_identidad,
            :idventa,
            :idplan"
            . ($idregalo == null ? "" : ", :idregalo") .
            ")";

        $sentencia = $conexion->prepare($consulta);

        $sentencia->bindParam(":nombres", $nombres);
        $sentencia->bindParam(":apellidopa", $apellidopa);
        $sentencia->bindParam(":apellidoma", $apellidoma);
        $sentencia->bindParam(":email", $email);
        $sentencia->bindParam(":telefono", $telefono);
        $sentencia->bindParam(":doc_identidad", $doc_identidad);
        $sentencia->bindParam(":idventa", $idventa);
        $sentencia->bindParam(":idplan", $idplan);

        if ($idregalo != null)
            $sentencia->bindParam(":idregalo", $idregalo);


        $sentencia->execute();

        $resultado['id'] = $conexion->lastInsertId();
        $resultado['filas'] = $sentencia->rowCount();

        $sentencia->closeCursor();
    }

    public function leerTodos()
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->query("SELECT * FROM v_boleta;");

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $conexion = null;
        $sentencia = null;

        return $resultado;
    }

    public function leer($id)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare("SELECT * FROM v_boleta WHERE idboleto = :idboleto;");

        $sentencia->bindParam(":idboleto", $id);

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $conexion = null;
        $sentencia = null;

        return $resultado;
    }

    public function eliminar(int $idboleto, int $idpersona)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare(
            "DELETE FROM boleto 
            WHERE idboleto = :idboleto 
            AND idpersona = :idpersona ;"
        );

        $sentencia->bindParam(":idboleto", $idboleto);
        $sentencia->bindParam(":idpersona", $idpersona);

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    public function actualizarSinVentaRegalo(
        int $idboleto,
        string $nombres,
        string $apellidopa,
        string $apellidoma,
        string $email,
        string $telefono,
        string $doc_identidad,
        int $idplan
    ) {
    }
}
