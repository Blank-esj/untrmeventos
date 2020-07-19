<?php

class ControladorBoleto
{
    public function guardarBoleto($post): string
    {
        //include_once '../../controlador/bd_conexion_pdo.php';
        $conn = (new Conexion())->conectarPDO();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Reporte de errores en modo Lanzar exceptiones, esto para que las transacciones sean automáticamente revertidas si la excepción causa la finalización del script. (https://www.php.net/manual/es/pdo.setattribute.php)

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            $datos = array(
                $post['nombres'],
                $post['apellidopa'],
                $post['apellidoma'],
                $post['email'],
                $post['telefono'],
                $post['doc_identidad'],
                $post['idplan'],
                $post['idregalo'],
                $post['descripcion']
            );

            $consulta = "CALL sp_crear_boleto (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Si $idregalo no es entero cambiamos de procedimiento almacenado y quitamos del array $datos el elemento $idregalo
            if (!intval($post['idregalo'])) {
                $consulta = "CALL sp_crear_boleto_sinregalo (?, ?, ?, ?, ?, ?, ?, ?)";
                array_splice($datos, 7, 1); // eliminamos el idregalo del array $datos
            }

            $sentenciaBoleto =  $conn->prepare($consulta); // Preparamos la consulta

            $sentenciaBoleto->execute($datos); // llama al procedimiento almacenado pasandole el array $datos

            $idboleto = $sentenciaBoleto->fetch(PDO::FETCH_ASSOC)['idboleto']; // Devuelve la siguiente fila como un array indexado por nombre de colunmna

            $sentenciaBoleto->closeCursor();

            if ($post['articulos']) {
                $this->vincularArticulos($conn, $post['articulos'], $idboleto);
            }

            $conn->commit();

            return json_encode(array(
                'respuesta' => 'exito',
                'mensaje' => "Guardado Satisfactoriamente"
            ));
        } catch (PDOException $e) {
            $conn->rollBack();
            return json_encode(array(
                'respuesta' => 'error',
                'mensaje' => $e->getMessage()
            ));
        }
        $conn = null;
    }

    private function vincularArticulos($conexion, $arrayArticulo, $idboleto): void
    {
        $datosTablaArticuloBoleto = array();
        $indice = 0;
        $consulta = "INSERT INTO articulo_boleto (idboleto, idarticulo, cantidad) VALUES ";
        foreach ($arrayArticulo as $idarticulo => $cantidad) {
            $consulta .= "(?, ?, ?)";
            $consulta .= (++$indice < count($arrayArticulo)) ? ", " : ";";

            array_push($datosTablaArticuloBoleto, $idboleto, (string)$idarticulo, $cantidad);
        };

        $sentenciaArticulos = $conexion->prepare($consulta);
        $sentenciaArticulos->execute($datosTablaArticuloBoleto);
        $sentenciaArticulos->closeCursor();
    }
}
