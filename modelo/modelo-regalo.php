<?php
class RegaloModelo
{
    /**
     * Devuelve un array con todos los regalos existentes en la base de datos
     */
    public function leerRegalos(): array
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->query('SELECT * FROM regalo;');

        $regalos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $regalos;
    }

    public function leerRegalo($idregalo)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare('SELECT * FROM regalo WHERE idregalo = :idregalo;');
        $sentencia->bindParam(':idregalo', $idregalo, PDO::PARAM_INT);
        $sentencia->execute();

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Devuelve un array con el id insertado y el numero de filas afectas
     */
    public function crear($nombre, $stock)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare('INSERT INTO regalo (nombre_regalo, stock) VALUES (:nombre, :stock);');
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':stock', $stock);

        $sentencia->execute();

        $resultado['filas'] = $sentencia->rowCount();
        $resultado['id'] = $conexion->lastInsertId();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Devuelve el número de filas afectadas
     */
    public function actualizar($idregalo, $nombre, $stock)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare('UPDATE regalo SET nombre_regalo = :nombre, stock = :stock WHERE idregalo = :idregalo;');
        $sentencia->bindParam(':idregalo', $idregalo, PDO::PARAM_INT);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':stock', $stock);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Devuelve el numero de filas afectadas
     */
    public function eliminar($idregalo)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare('DELETE FROM regalo WHERE idregalo = :idregalo ;');
        $sentencia->bindParam(':idregalo', $idregalo, PDO::PARAM_INT);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * Devuelve un array conteniendo los ids de los regalos
     */
    public function leerIdsRegalo(): array
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $idsRegalos = [];
        $sentencia = $conexion->query('SELECT idregalo FROM regalo;');

        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $indice => $arreglo) {
            $idsRegalos[$indice] = $arreglo['idregalo'];
        }

        $sentencia = null;
        $conexion = null;

        return $idsRegalos;
    }

    /**
     * Devuelve true si encuentra algún nombre en la base de datos
     */
    public function existeRegalo($idsRegalo)
    {
        return in_array($this->leerIdsRegalo(), $idsRegalo);
    }

    /**
     * Hace una consulta a la base de datos solicitando el nombre por el id que le pases por parámetro
     */
    public function leerNombreRegalo($idsRegalo)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conexion = (new Conexion())->conectarPDO();

        $sentencia = $conexion->prepare('SELECT nombre_regalo FROM regalo WHERE idregalo = :idregalo;');
        $sentencia->bindParam(':idregalo', $idsRegalo, PDO::PARAM_INT);
        $sentencia->execute();

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC)[0]['nombre_regalo'];

        $sentencia = null;
        $conexion = null;

        return $resultado;
    }

    /**
     * 
     */
    public function arrayNombres()
    {
        $nombres = [];
        foreach ($this->leerRegalos() as $indice => $arreglo) {
            $nombres[$arreglo['idregalo']] = $arreglo['nombre_regalo'];
        }

        return $nombres;
    }

    private function quitarBoleto()
    {
    }

    private function agregarBoleto()
    {
    }

    private function actualizarBoleto()
    {
    }
}
