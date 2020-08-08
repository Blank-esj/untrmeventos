<?php

class BoletoModelo
{

    private function insertar(\PDO $conexion = null, $idpersona, $idventa, $idplan, $idregalo)
    {
        $conn = $conexion;
        if (!isset($conn)) {
            include_once 'controlador/util/bd_conexion_pdo.php';
            $conn = (new Conexion())->conectarPDO();
        }

        $sentencia = $conn->prepare("INSERT INTO boleto (idpersona, idventa, idplan, idregalo) VALUES (:idpersona, :idventa, :idplan, :idregalo);");

        $sentencia->bindParam(":idpersona", $idpersona, PDO::PARAM_INT);
        $sentencia->bindParam(":idventa", $idventa);
        $sentencia->bindParam(":idplan", $idplan, PDO::PARAM_INT);
        $sentencia->bindParam(":idregalo", $idregalo);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia->closeCursor();

        $sentencia = null;

        if (isset($conn)) $conn = null;

        return $resultado;
    }

    /**
     * @param return bool
     */
    public function crear(
        string $nombres,
        string $apellidopa,
        string $apellidoma,
        string $email = null,
        string $telefono = null,
        string $doc_identidad = null,
        int $idventa = null,
        int $idplan,
        int $idregalo = null
    ) {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();
        $rpta = false;

        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            if (!$this->crearVincular($conn, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad, $idventa, $idplan, $idregalo)) {
                throw new Exception("No se creó el boleto");
            };

            $conn->commit(); // Guadamos los cambios
            $rpta = true;
        } catch (\Throwable $th) {
            $conn->rollBack(); // Revertimos los cambios
            //throw new Exception("No se creó el boleto <br/>" . $th);
        }

        $conn = null;
        return $rpta;
    }


    /**
     * Crea un nuevo boleto sin tomar en cuenta los articulos y retorna el id del boleto creado
     * @param mixed $conexion objeto de la conexión a la base de datos
     * @param mixed $post array del método HTTP $_POST
     */
    public function crearVincular(
        \PDO &$conexion,
        string $nombres,
        string $apellidopa,
        string $apellidoma,
        string $email = null,
        string $telefono = null,
        string $doc_identidad = null,
        int $idventa = null,
        int $idplan,
        int $idregalo = null
    ) {
        if (isset($idregalo)) {

            include_once 'modelo-regalo.php';

            $regalo = (new RegaloModelo())->leerRegalo($idregalo);

            if (!$regalo) throw new Exception("No existe este regalo");

            if (0 >= (float)$regalo[0]['stock']) throw new Exception("No queda stock de " . $regalo[0]['nombre_regalo']);

            if ($this->alterarStock($conexion, $idregalo, -1, false) <= 0) return false;
        }

        include_once 'modelo-persona.php';

        $personaModelo = new PersonaModelo();

        // El último Id de Persona
        $_idpersona = $personaModelo->ultimoIdVincular($conexion) + 1;

        // Creamos la persona
        if (0 >= $personaModelo->crearVincular($conexion, $_idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad)) return false;

        if (0 >= $this->insertar($conexion, $_idpersona, $idventa, $idplan, $idregalo)) return false;

        return true;
    }

    /**
     * Aumenta o disminuye lacantidad del stock de la tabla regalo
     * @param float $cantidad cantidad que se sumará o restará con el stock
     * @param bool $aumentar Si está en true aumenta sino disminuye el stock
     */
    public function alterarStock(\PDO &$conexion, int $idregalo, float $cantidad, bool $aumentar = true)
    {
        $_sql = "UPDATE regalo SET stock = stock " . ($aumentar ? "+" : "-") . " :cantidad WHERE idregalo = :idregalo";

        $sentenss = $conexion->prepare($_sql);

        $sentenss->bindParam(":idregalo", $idregalo, PDO::PARAM_INT);
        $sentenss->bindParam(":cantidad", $cantidad);

        $sentenss->execute();

        $_rows = $sentenss->rowCount();

        $sentenss = null;

        return $_rows;
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

    public function actualizarVincular(
        \PDO &$conexion,
        int $idboleto,
        string $nombres,
        string $apellidopa,
        string $apellidoma,
        string $email = null,
        string $telefono = null,
        string $doc_identidad = null,
        int $idventa = null,
        int $idplan,
        int $idregalo = null
    ) {
        $boletoAnterior = $this->leer($idboleto)[0];

        // ¿RegaloAnterior y RegaloNuevo son diferentes?
        if ($boletoAnterior['idregalo'] != $idregalo) {
            // ¿RegaloNuevo tiene valor?
            if (isset($idregalo)) {

                $regalo = $this->leer($idregalo);

                // ¿RegaloNuevo existe en la db?
                if ($regalo == false) throw new Exception("No hay registro de este regalo");

                // ¿RegaloNuevo tiene stock?
                if (0 >= $regalo[0]['stock']) throw new Exception($regalo[0]['nombre_regalo'] . " no tiene stock");

                // Disminuye el stock de RegaloNuevo
                $this->alterarStock($conexion, $idregalo, -1, false);

                // ¿RegaloAnterior tiene valor?
                if ($boletoAnterior['stock'] != null) $this->alterarStock($conexion, (int)$idregalo, 1);
            } else {
                $this->alterarStock($conexion, (int)$idregalo, 1);
            }
        }

        include_once 'modelo-persona.php';

        $personaModelo = new PersonaModelo();

        $personaModelo->crearVincular($conexion, $boletoAnterior['idpersona'], $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad);

        $this->insertar($conexion, $boletoAnterior['idpersona'], $idventa, $idplan, $idregalo);
    }
}
