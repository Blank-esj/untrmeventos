<?php
class RegaloModelo
{
    /**
     * Devuelve un array con todos los regalos existentes en la base de datos
     */
    public function leerRegalos($conexion): array
    {
        $sentencia = $conexion->prepare('SELECT * FROM regalo;');
        $sentencia->execute();
        $regalos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia->closeCursor();
        return $regalos;
    }

    /**
     * Devuelve un array conteniendo los ids de los regalos
     */
    public function leerIdsRegalo($conexion): array
    {
        $idsRegalos = [];
        $sentencia = $conexion->query('SELECT idregalo FROM regalo;');

        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $indice => $arreglo) {
            $idsRegalos[$indice] = $arreglo['idregalo'];
        }

        $sentencia->closeCursor();

        return $idsRegalos;
    }

    /**
     * Devuelve true si encuentra algún nombre en la base de datos
     */
    public function existeRegalo($conexion, $idsRegalo)
    {
        return in_array($this->leerIdsRegalo($conexion), $idsRegalo);
    }

    /**
     * Hace una consulta a la base de datos solicitando el nombre por el id que le pases por parámetro
     */
    public function leerNombreRegalo($conexion, $idsRegalo)
    {
        $sentencia = $conexion->prepare('SELECT nombre_regalo FROM regalo WHERE idregalo = :idregalo;');
        $sentencia->bindParam(':idregalo', $idsRegalo, PDO::PARAM_INT);
        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_ASSOC)[0]['nombre_regalo'];
    }

    /**
     * 
     */
    public function arrayNombres($conexion)
    {
        $nombres = [];
        foreach ($this->leerRegalos($conexion) as $indice => $arreglo) {
            $nombres[$arreglo['idregalo']] = $arreglo['nombre_regalo'];
        }
        return $nombres;
    }
}
