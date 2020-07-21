<?php

class ControladorBoleto
{
    /**
     * Guarda un boleto considerando los articulos
     * @param mixed $conexion instancia del objeto Conexion a la base de datos
     * @param mixed $post array del método HTTP $_POST
     * @return string json codificado con la respuesta y un mensaje
     */
    public function guardarBoleto($conexion, $post): string
    {
        $conn = $conexion->conectarPDO();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            $idboleto = $this->crearBoleto($conn, $post); // creamos el boleto y guardamos su id

            if ($post['articulos']) {
                $this->vincularArticulos(
                    $conn, // conexión con que se está trabajando
                    $post['articulos'], // array que contiene el idarticulo y cantidad
                    $idboleto
                );
            }

            $conn->commit(); // Guadamos los cambios

            return json_encode(array(
                'respuesta' => 'exito',
                'mensaje' => "Guardado Satisfactoriamente"
            ));
        } catch (PDOException $e) {
            $conn->rollBack(); // Revertimos los cambios
            return json_encode(array(
                'respuesta' => 'error',
                'mensaje' => $e->getMessage()
            ));
        }
        $conn = null;
    }

    /**
     * Crea un nuevo boleto sin tomar en cuenta los articulos y retorna el id del boleto creado
     * @param mixed $conexion objeto de la conexión a la base de datos
     * @param mixed $post array del método HTTP $_POST
     * @return string id del boleto creado
     */
    public function crearBoleto($conexion, $post): string
    {
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

        $sentenciaBoleto =  $conexion->prepare($consulta); // Preparamos la consulta
        $sentenciaBoleto->execute($datos); // llama al procedimiento almacenado pasandole el array $datos
        $idboleto = $sentenciaBoleto->fetch(PDO::FETCH_ASSOC)['idboleto']; // recuperamos el id del boleto guardado anteriormente
        $sentenciaBoleto->closeCursor(); // cerramos el cursor para poder realizar otras consultas
        return $idboleto;
    }

    /**
     * @param mixed $conexion objeto de la conexión a la base de datos
     * @param mixed $arrayArticulo array que contiene los datos (idarticulo y cantidad) del articulo
     * ```
     * array({1 => 4, 7 => 2}); // donde la clave es el id y el valor es la cantidad del articulo
     * ```
     * @param mixed $idboleto id del boleto al que se le asignará los valores (id y cantidad) del array de articulo
     */
    public function vincularArticulos($conexion, $arrayArticulo, $idboleto): void
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

    /**
     * Obtiene un array con el nombre y precio de un determinado plan
     * @param mixed $conexion Instancia de la conexion a la base de datos
     * @param mixed $idplan id del plan al que se desea consultar
     * @return array array que retorna
     */
    public function obtenerNombrePrecioPlan($conexion, $idplan): array
    {
        $sentenciaPlan = $conexion->prepare('SELECT nombre, precio FROM plan WHERE idplan = :idplan');
        $sentenciaPlan->bindParam(':idplan', $idplan, PDO::PARAM_INT);
        $sentenciaPlan->execute();
        $resultado = $sentenciaPlan->fetch(PDO::FETCH_ASSOC);
        $sentenciaPlan->closeCursor();
        return $resultado;
    }

    /**
     * Obtiene todos los articulos por el id que se le pasa en el array de articulos
     */
    public function obtenerArticulos($conexion, $arrayArticulo): array
    {
        $nombresPrecios = array();
        $sentenciaArticulos = $conexion->prepare("SELECT * FROM articulo WHERE idarticulo = ?;");
        foreach ($arrayArticulo as $idarticulo => $cantidad) {
            $sentenciaArticulos->execute(array((string)$idarticulo));
            array_push(
                $nombresPrecios, 
                ($sentenciaArticulos->fetchAll(PDO::FETCH_ASSOC))[0]
            );
            $sentenciaArticulos->closeCursor();
        };

        return $nombresPrecios;
    }
}

/*
if ($_POST['registro'] == 'actualizar') {
    try {
        $stmt = $conn->prepare("CALL sp_actualizar_registrado (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, 1 ) ");
        $stmt->bind_param("issssssssssis", $id_registro, $nombre, $apellidopa, $apellidoma, $email, $direccion, $telefono, $celular, $nacimiento, $pedido, $registro_eventos, $regalo, $total);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $id_registro
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}

if ($_POST['registro'] == 'eliminar') {
    $id_borrar = $_POST['id'];
    try {
        $stmt = $conn->prepare("DELETE FROM persona WHERE idpersona = ? ");
        $stmt->bind_param('i', $id_borrar);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}*/
