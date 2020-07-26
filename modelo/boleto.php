<?php

class Boleto
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
        if ($idregalo == null) {
            $sentencia = $conexion->prepare("CALL sp_crear_boleto_sinregalo(
                :nombres,
                :apellidopa,
                :apellidoma,
                :email,
                :telefono,
                :doc_identidad,
                :idventa,
                :idplan
            )");

            $sentencia->bindParam(":nombres", $nombres);
            $sentencia->bindParam(":apellidopa", $apellidopa);
            $sentencia->bindParam(":apellidoma", $apellidoma);
            $sentencia->bindParam(":email", $email);
            $sentencia->bindParam(":telefono", $telefono);
            $sentencia->bindParam(":doc_identidad", $doc_identidad);
            $sentencia->bindParam(":idventa", $idventa);
            $sentencia->bindParam(":idplan", $idplan);
        } else {
            $sentencia = $conexion->prepare("CALL sp_crear_boleto(
                :nombres,
                :apellidopa,
                :apellidoma,
                :email,
                :telefono,
                :doc_identidad,
                :idventa,
                :idplan,
                :idregalo
            )");

            $sentencia->bindParam(":nombres", $nombres);
            $sentencia->bindParam(":apellidopa", $apellidopa);
            $sentencia->bindParam(":apellidoma", $apellidoma);
            $sentencia->bindParam(":email", $email);
            $sentencia->bindParam(":telefono", $telefono);
            $sentencia->bindParam(":doc_identidad", $doc_identidad);
            $sentencia->bindParam(":idventa", $idventa);
            $sentencia->bindParam(":idplan", $idplan);
            $sentencia->bindParam(":idregalo", $idregalo);
        }

        $sentencia->execute();
    }

}